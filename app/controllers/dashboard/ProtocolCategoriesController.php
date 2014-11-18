<?php

class ProtocolCategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private static $module_id = 10;

	public function index()
	{
		$module = Module::find(self::$module_id);
		$models = Auth::user()->preferredCompany->protocolCategories()->orderBy('t09_id')->paginate(20);
		$category_default = new ProtocolCategory;
		$titles_table = $category_default->getMainAttributesNames();
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
		$category = new ProtocolCategory;
		$action_model = 'Crear '.$module->model->singular_name;
		
		$form_data = array('route' => 'dashboard.'.$module->route.'.store', 'method' => 'POST');
		return View::make('dashboard.pages.models.protocolcategory.form', compact('action_model', 'category', 'module', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$module = Module::find(self::$module_id);
        $category = new ProtocolCategory;
        $data = Input::all();
        
        if ($category->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create')->withInput()->withErrors($category->errors);
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
		$model = ProtocolCategory::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = $module->model->singular_name.': '.$model->t09_name;

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
		$category = ProtocolCategory::findOrFail($id);
		$module = Module::find(self::$module_id);
		$action_model = 'Editar '.$module->model->singular_name.': '.$category->t09_name;

		$form_data = array('route' => array('dashboard.'.$module->route.'.update', $category->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.models.protocolcategory.form', compact('action_model', 'category', 'form_data', 'module'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = ProtocolCategory::findOrFail($id);
		$module = Module::find(self::$module_id);
        $data = Input::all();
        if ($category->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
        else
        {
			return Redirect::route(array('dashboard.'.$module->route.'.edit', $category->id))->withInput()->withErrors($category->errors);
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
    	$category = ProtocolCategory::findOrFail($id);
    	$module = Module::find(self::$module_id);
        $category->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Categoría "' . $category->t09_name . '" eliminada',
                'id'      => $category->id
            ));
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index');
        }
	}
}
