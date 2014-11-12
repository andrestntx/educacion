<?php

class ProtocolsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	private static $module_id = 6;

	public function index()
	{
		$module = Module::find(self::$module_id);
		$models = Protocol::orderBy('t06_id')->paginate(20);
		$protocol_default = new Protocol;
		$titles_table = $protocol_default->getMainAttributesNames();
		$actions = array('show', 'edit', 'destroy');

		return View::make('dashboard.pages.models.generic.list-table', compact('models', 'titles_table', 'module', 'actions'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$module = Module::find(self::$module_id);
		$protocol = new Protocol;
		$action_model = 'Crear '.$module->model->singular_name;

		$users = Session::get('actual_company')->users()->lists('t02_name', 't02_id');
		
		$form_data = array('route' => 'dashboard.'.$module->route.'.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.models.protocol.form', compact('action_model', 'protocol', 'module', 'form_data', 'users'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$module = Module::find(self::$module_id);
        $protocol = new Protocol;
        $data = Input::all();
        
        if ($protocol->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create')->withInput()->withErrors($protocol->errors);
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
		$model = Protocol::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = $module->model->singular_name.': '.$model->t01_name;

		return View::make('dashboard.pages.models.generic.show', compact('action_model', 'model', 'module'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$protocol = Protocol::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = 'Editar '.$module->model->singular_name.': '.$protocol->t06_name;
		$users = Session::get('actual_company')->users()->lists('t02_name', 't02_id');

		$form_data = array('route' => array('dashboard.'.$module->route.'.update', $protocol->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.models.protocol.form', compact('action_model', 'users', 'protocol', 'form_data', 'module'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$protocol = Protocol::findOrFail($id);
		$module = Module::find(self::$module_id);
        $data = Input::all();
        if ($protocol->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route(array('dashboard.'.$module->route.'.edit', $protocol->id))->withInput()->withErrors($protocol->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$protocol = Protocol::findOrFail($id);
    	$module = Module::find(self::$module_id);
        $protocol->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Protocolo "' . $protocol->t06_name . '" eliminado',
                'id'      => $protocol->id
            ));
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
	}


}
