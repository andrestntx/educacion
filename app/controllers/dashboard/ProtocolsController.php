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

		return View::make('dashboard.pages.models.protocol.list', compact('models', 'titles_table', 'module', 'actions'));
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
		
		$form_data = array('route' => 'dashboard.'.$module->route.'.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.models.protocol.form', compact('action_model', 'protocol', 'module', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
