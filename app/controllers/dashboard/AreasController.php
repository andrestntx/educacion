<?php

class AreasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private static $module_id = 9;

	public function index()
	{
		$module = Module::find(self::$module_id);
		$models = Auth::user()->preferredCompany->areas()->orderBy('t07_id')->paginate(20);
		$userRole_default = new Area;
		$titles_table = $userRole_default->getMainAttributesNames();
		$actions = array(
			'show', 'edit', 'destroy'
		);

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
		$area = new Area;
		$action_model = 'Crear '.$module->model->singular_name;
		
		$form_data = array('route' => 'dashboard.'.$module->route.'.store', 'method' => 'POST');
		return View::make('dashboard.pages.models.area.form', compact('action_model', 'area', 'module', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$module = Module::find(self::$module_id);
        $area = new Area;
        $data = Input::all();
        
        if ($area->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create')->withInput()->withErrors($area->errors);
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
		$model = Area::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = $module->model->singular_name.': '.$model->t07_name;

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
		$area = Area::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = 'Editar '.$module->model->singular_name.': '.$area->t07_name;

		$form_data = array('route' => array('dashboard.'.$module->route.'.update', $area->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.models.area.form', compact('action_model', 'area', 'form_data', 'module'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$area = Area::findOrFail($id);
		$module = Module::find(self::$module_id);
        $data = Input::all();
        if ($area->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route(array('dashboard.'.$module->route.'.edit', $area->id))->withInput()->withErrors($area->errors);
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
    	$area = Area::findOrFail($id);
    	$module = Module::find(self::$module_id);
        $area->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Area "' . $area->t07_name . '" eliminada',
                'id'      => $area->id
            ));
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
	}
}
