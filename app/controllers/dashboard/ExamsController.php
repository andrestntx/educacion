<?php 
	/**
	* 
	*/

	class ExamsController extends BaseController
	{
		public function studyProtocol($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			$user = User::with(array('examScores' => function($query) use($protocol)
			{
			    $query->whereSurveyId($protocol->survey_id);

			}))->whereId(Auth::user()->id)->first();	
			return View::make('dashboard.pages.protocol.show', compact('protocol', 'user'));
		}

		public function create($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			$protocol->load('survey.questions');
			if(!$protocol->survey_aviable)
			{
				App::abort('404');
			}

			$exam = new ResolvedSurvey;
			$form_data = array('route' => array('examenes.store', $protocol->id), 'method' => 'POST');
			return View::make('dashboard.pages.exam.form', compact('protocol', 'exam', 'form_data'));

			
		}

		public function store($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			$data = Input::only('answers');
			$exam = ResolvedSurvey::create(array('survey_id' => $protocol->survey_id, 'user_id' => Auth::user()->id));
			$exam->answers()->attach($data['answers']);
			return Redirect::to('/');
		}
	}
 ?>