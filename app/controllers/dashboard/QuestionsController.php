<?php

class QuestionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $module_id = 12;

	public function index($protocol_id)
	{
		$protocol = Protocol::findOrFail($protocol_id);
		$models = $protocol->questions()->orderBy('t14_id')->paginate(20);
		$module = Module::find($this->module_id);
		
		$question_default = new Question;
		$titles_table = $question_default->getMainAttributesNames();
		$actions = array('edit', 'destroy');
		$model_father_id = $protocol_id;
		$route_destroy = array('dashboard.'.$module->route.'.destroy', $protocol_id, 'USER_ID');
		
		return View::make('dashboard.pages.models.question.lists', compact(
			'title_page', 'models', 'titles_table', 'module', 'actions', 'model_father_id', 'route_destroy', 'protocol')); 
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($protocol_id)
	{
		$protocol = Protocol::findOrFail($protocol_id);
		$module = Module::find($this->module_id);	
		$question = new Question;

		$number_answers = Input::get('answers');

		$action_model = 'Crear '.$module->model->singular_name;
		$route_index = route('dashboard.'.$module->route.'.index', $protocol_id);
		$form_data = array('route' => array('dashboard.'.$module->route.'.store', $protocol_id), 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.models.question.form', compact(
			'action_model', 'question', 'module', 'form_data', 'route_index', 'protocol', 'number_answers'
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($protocol_id)
	{
		$module = Module::find($this->module_id);
        $question = new Question;
        $data = Input::all();

        if ($question->validAndSave($data) && $question->saveAnswers($data['answers']))
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $protocol_id);
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create', array($protocol_id, 'answers='.count($data['answers'])))->withInput()->withErrors($question->errors);
        } 
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($protocol_id, $id)
	{
		$protocol = Protocol::findOrFail($protocol_id);
		$module = Module::find($this->module_id);
		$question = Question::findOrFail($id);
		$number_answers = $question->answers->count();

		$action_model = 'Editar '.$module->model->singular_name.': '.$question->t11_name;

		$form_data = array(
			'route' => array('dashboard.'.$module->route.'.update', $protocol->id, $question->id), 
			'method' => 'PUT', 
			'files' => true
		);

		$route_index = route('dashboard.'.$module->route.'.index', $protocol_id);
		return View::make('dashboard.pages.models.question.form-edit', compact(
				'action_model', 'question', 'form_data', 
				'module', 'route_index', 'protocol', 'number_answers'
			)
		);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($protocol_id, $id)
	{
		$module = Module::find($this->module_id);
        $question = Question::find($id);
        $data = Input::all();

        if ($question->validAndSave($data) && $question->updateAnswers($data['answers']))
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $protocol_id);
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.edit', array($protocol_id, $id))->withInput()->withErrors($question->errors);
        } 
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($protocol_id, $id)
	{
		$module = Module::find($this->module_id);
    	$question = Question::findOrFail($id);
        $question->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Pregunta "' . $question->t15_text . '" eliminada',
                'id'      => $question->id
            ));
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $protocol_id);
        }
	}


}
