<?php

class UserRolesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private static $module_id = 8;

	public function index()
	{
		$module = Module::find(self::$module_id);
		$models = Auth::user()->preferredCompany->roles()->orderBy('t03_id')->paginate(20);
		$userRole_default = new UserRole;
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
		$role = new UserRole;
		$action_model = 'Crear '.$module->model->singular_name;
		
		$form_data = array('route' => 'dashboard.'.$module->route.'.store', 'method' => 'POST');
		return View::make('dashboard.pages.models.userrole.form', compact('action_model', 'role', 'module', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$module = Module::find(self::$module_id);
        $role = new UserRole;
        $data = Input::all();
        
        if ($role->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create')->withInput()->withErrors($role->errors);
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
		$model = UserRole::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = $module->model->singular_name.': '.$model->t03_name;

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
		$role = UserRole::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = 'Editar '.$module->model->singular_name.': '.$role->t03_name;

		$form_data = array('route' => array('dashboard.'.$module->route.'.update', $role->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.models.userrole.form', compact('action_model', 'role', 'form_data', 'module'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = UserRole::findOrFail($id);
		$module = Module::find(self::$module_id);
        $data = Input::all();
        if ($role->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route(array('dashboard.'.$module->route.'.edit', $role->id))->withInput()->withErrors($role->errors);
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
    	$role = UserRole::findOrFail($id);
    	$module = Module::find(self::$module_id);
        $role->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Perfil "' . $role->t03_name . '" eliminado',
                'id'      => $role->id
            ));
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
	}
}
