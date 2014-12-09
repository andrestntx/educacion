<?php

class CompaniesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	private static $module_id = 4;

	public function index()
	{
		$module = Module::find(self::$module_id);
		$models = Company::where('t01_id', '<>', 1)->orderBy('t01_id')->paginate(20);
		$company_default = new Company;
		$titles_table = $company_default->getMainAttributesNames();
		$actions = array(
			'edit', 
			'show_models' => array('models' => 'users', 'icon' => 'fa-users', 'name' => 'Ver Usuario'),
			'destroy'
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
		$company = new Company;
		$action_model = 'Crear '.$module->model->singular_name;
		
		$form_data = array('route' => 'dashboard.'.$module->route.'.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.models.company.form', compact('action_model', 'company', 'module', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$module = Module::find(self::$module_id);
        $company = new Company;
        $data = Input::all();
        
        if ($company->validAndSave($data))
        {
        	$company->createDefaultData();
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
		$model = Company::findOrFail($id);
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
		$company = Company::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = 'Editar '.$module->model->singular_name.': '.$company->t01_name;

		$form_data = array('route' => array('dashboard.'.$module->route.'.update', $company->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.models.company.form', compact('action_model', 'company', 'form_data', 'module'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$company = Company::findOrFail($id);
		$module = Module::find(self::$module_id);
        $data = Input::all();
        if ($company->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route(array('dashboard.'.$module->route.'.edit', $company->id))->withInput()->withErrors($company->errors);
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
    	$company = Company::findOrFail($id);
    	$module = Module::find(self::$module_id);
    	try {
    		$company->delete();
    		$result = array('success' => true, 'msg' => 'Institución "' . $company->t01_name . '" eliminada', 'id' => $company->id);
    	} catch (Exception $e) {
    		$result = array('success' => false, 'msg' => 'La Institución no se puede eliminar', 'id' => $company->id);
    	}
   

        if (Request::ajax())
        {
            return Response::json($result);
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
	}
}
