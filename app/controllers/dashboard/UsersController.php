<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	private $module_id = 5;

	public function index()
	{
		$models = Auth::user()->preferredCompany->users()->where('t02_system_role_id', '<>', 2)->orderBy('t02_id')->paginate(20);
		$module = Module::find($this->module_id);
		
		$user_default = new User;
		$titles_table = $user_default->getMainAttributesNames();
		$actions = array(
			'show', 
			'edit',	'destroy'
		);

		return View::make('dashboard.pages.models.generic.list-table', compact(
			'title_page', 'models', 'titles_table', 'module', 'actions'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($company_id = null)
	{
		$user = new User;

		$module = Module::find($this->module_id);
		$roles = Auth::user()->preferredCompany->roles()->lists('t03_name', 't03_id');
		$areas = Auth::user()->preferredCompany->areas()->lists('t07_name', 't07_id');
		
		$system_roles = SystemRole::lists('sys01_name', 'sys01_id');
		$action_model = 'Crear '.$module->model->singular_name;
		
		$form_data = array('route' => 'dashboard.'.$module->route.'.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.models.user.form', compact(
			 'user', 'module', 'form_data', 'roles', 'action_model', 'areas'
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$module = Module::find($this->module_id);
        $company = new User;
        $data = Input::all();
        $data['t02_preferred_company_id'] = Auth::user()->preferredCompany->id;
        $data['t02_system_role_id'] = 3; 

        if ($company->validAndSave($data))
        {
        	$company->syncCompanies(array(Auth::user()->preferredCompany->id));
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create')->withInput()->withErrors($company->errors);
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
		$module = Module::find($this->module_id);
		$model = User::findOrFail($id);
		$action_model = $module->model->singular_name.': '.$model->t02_name;

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
		$module = Module::find($this->module_id);
		$user = User::findOrFail($id);


		$action_model = 'Editar '.$module->model->singular_name.': '.$user->t02_name;

		$roles = Auth::user()->preferredCompany->roles()->lists('t03_name', 't03_id');
		$areas = Auth::user()->preferredCompany->areas()->lists('t07_name', 't07_id');

		$form_data = array(
			'route' => array('dashboard.'.$module->route.'.update', $user->id), 
			'method' => 'PUT', 
			'files' => true
		);

		return View::make('dashboard.pages.models.user.form', compact(
				'action_model', 'user', 'form_data', 
				'module', 'roles', 'areas'
			)
		);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$module = Module::find($this->module_id);
		$user = User::findOrFail($id);
        
        $data = Input::all();

        $data['t02_preferred_company_id'] = Auth::user()->preferredCompany->id;
        $data['t02_system_role_id'] = 3; 
        if ($user->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
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
	public function destroy($id)
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
            return Redirect::route('dashboard.'.$module->model->route.'.index');
        }
	}
}
