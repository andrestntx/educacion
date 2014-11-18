<?php

class CompaniesUsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $module_id = 7;


	public function index($company_id)
	{
		$models = Company::findOrFail($company_id)->users()->orderBy('t02_id')->paginate(20);
		$module = Module::find($this->module_id);
		$user_default = new User;
		$titles_table = $user_default->getMainAttributesNames();
		$actions = array('show', 'edit', 'destroy');
		$model_father_id = $company_id;
		$route_create = route('dashboard.'.$module->route.'.create', $company_id);
		$route_destroy = array('dashboard.'.$module->route.'.destroy', $company_id, 'USER_ID');
		return View::make('dashboard.pages.models.generic.list-table', compact(
			'title_page', 'models', 'titles_table', 'module', 'actions', 'route_create', 'model_father_id', 'route_destroy')); 
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($company_id)
	{
		Company::findOrFail($company_id);
		$module = Module::find($this->module_id);
		$user = new User;
		$action_model = 'Crear '.$module->model->singular_name;
		$route_index = route('dashboard.'.$module->route.'.index', $company_id);
		$form_data = array('route' => array('dashboard.'.$module->route.'.store', $company_id), 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.models.user.form-superadmin', compact(
			'action_model', 'user', 'module', 'form_data', 'route_index'
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($company_id)
	{
		$module = Module::find($this->module_id);
        $company = new User;
        $data = Input::all();
        $data['t02_preferred_company_id'] = $company_id;
        $data['t02_system_role_id'] = 2; 
        if ($company->validAndSave($data))
        {
        	$company->syncCompanies(array($company_id));
            return Redirect::route('dashboard.'.$module->route.'.index', $company_id);
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create', $company_id)->withInput()->withErrors($company->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($company_id, $id)
	{
		Company::findOrFail($company_id);
		$module = Module::find($this->module_id);
		$model = User::findOrFail($id);
		$action_model = $module->model->singular_name.': '.$model->t02_name;
		$route_index = route('dashboard.'.$module->route.'.index', $company_id);
		$route_edit = route('dashboard.'.$module->route.'.edit', array($company_id, $id));
		$model_father_id = $company_id;

		return View::make('dashboard.pages.models.generic.show', compact('action_model', 'model', 'module', 'route_index', 'route_edit', 'model_father_id'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($company_id, $id)
	{
		Company::findOrFail($company_id);
		$module = Module::find($this->module_id);
		$user = User::findOrFail($id);

		$action_model = 'Editar '.$module->model->singular_name.': '.$user->t02_name;

		$form_data = array(
			'route' => array('dashboard.'.$module->route.'.update', $user->id), 
			'method' => 'PUT', 
			'files' => true
		);

		$route_index = route('dashboard.'.$module->route.'.index', $company_id);
		return View::make('dashboard.pages.models.user.form-superadmin', compact(
				'action_model', 'user', 'companies', 'system_roles', 'form_data', 
				'module', 'route_index'
			)
		);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($company_id, $id)
	{
		$module = Module::find($this->module_id);
		$user = User::findOrFail($id);
        
        $data = Input::all();
        $data['t02_preferred_company_id'] = $company_id;
        $data['t02_system_role_id'] = 2; 
        if ($user->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $company_id);
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.edit', $user->id)->withInput()->withErrors($user->errors);
        }	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($company_id, $id)
	{
		$module = Module::find($this->module_id);
    	$user = User::findOrFail($id);
        $user->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Usuario "' . $user->t02_name . '" eliminado',
                'id'      => $user->id
            ));
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $company_id);
        }
	}


}
