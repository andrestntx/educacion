<?php 
	/**
	* 
	*/

	class ExamsController extends BaseController
	{
		public function studyProtocol($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			return View::make('dashboard.pages.models.protocol.study', compact('protocol'));
		}

		public function create($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			$exam = new Exam;
			$form_data = array('route' => array('dashboard.exams.store', $protocol->id), 'method' => 'POST');
			return View::make('dashboard.pages.models.exam.form', compact('protocol', 'exam', 'form_data'));
		}

		public function store($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			$exam = Exam::create(array('t16_protocol_id' => $protocol->id, 't16_user_id' => Auth::user()->id));
			return Redirect::to('dashboard');
		}
	}
 ?>