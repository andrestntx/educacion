<?php

class GlobalModelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$globalModel = GlobalModel::getGlobalModel();
		$models = GlobalModel::where('sys03_id', '>', 1)->paginate(20);

		$table = array(
			'sys03_id' => array('title' => 'Id', 'type' => 'string'), 
			'singular_name' => array('title' => 'Nombre singular', 'type' => 'string'), 
			'plural_name' => array('title' => 'Nombre plural', 'type' => 'string'),
			'created_at' => array('title' => 'Creación', 'type' => 'string'), 
			'updated_at' => array('title' => 'Actualición', 'type' => 'string'), 
			'action' => array(
				'title' => 'Acción', 
				'type' => 'action-group-resource', 
				'actions' => array('show', 'edit')
			)
		);

		return View::make('dashboard/pages/models/list-table', compact('models', 'table', 'globalModel'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$model = GlobalModel::findOrFail($id);
		$globalModel = GlobalModel::getGlobalModel();
		$action_model = $globalModel->singular_name.': '.$model->singular_name;
		$attributes = $model->getAttributesArray();

		return View::make('dashboard/pages/models/show', compact('action_model', 'attributes', 'model', 'globalModel'));

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$model = GlobalModel::findOrFail($id);
		$globalModel = GlobalModel::getGlobalModel();
		$action_model = 'Editar '.$globalModel->singular_name.': '.$model->singular_name;

		$form_data = array('route' => array('dashboard.'.$globalModel->route.'.update', $model->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard/pages/models/form', compact('action_model', 'model', 'form_data', 'globalModel'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$model = GlobalModel::findOrFail($id);
		$globalModel = GlobalModel::getGlobalModel();
        $data = Input::all();
        if ($model->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$globalModel->route.'.index');
        }
        else
        {
			return Redirect::route('dashboard.'.$globalModel->route.'.edit', $model->id)->withInput()->withErrors($model->errors);
        }	
	}


}
