<?php

class AnnexController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $module_id = 11;


	public function index($protocol_id)
	{
		$protocol = Protocol::findOrFail($protocol_id);
		$models = $protocol->annex()->orderBy('t11_id')->paginate(20);
		$module = Module::find($this->module_id);
		$annex_default = new Annex;
		$titles_table = $annex_default->getMainAttributesNames();
		$actions = array('show', 'edit', 'destroy');
		$model_father_id = $protocol_id;
		$route_destroy = array('dashboard.'.$module->route.'.destroy', $protocol_id, 'USER_ID');

		return View::make('dashboard.pages.models.annex.lists', compact(
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
		$annex = new Annex;
		$action_model = 'Subir '.$module->model->singular_name;
		$route_index = route('dashboard.'.$module->route.'.index', $protocol_id);
		$form_data = array('route' => array('dashboard.'.$module->route.'.store', $protocol_id), 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.models.annex.form', compact(
			'action_model', 'annex', 'module', 'form_data', 'route_index', 'protocol'
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
        $annex = new Annex;
        $data = Input::all();
        if ($annex->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $protocol_id);
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.create', $protocol_id)->withInput()->withErrors($annex->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($protocol_id, $id)
	{
		Protocol::findOrFail($protocol_id);
		$module = Module::find($this->module_id);
		$model = Annex::findOrFail($id);
		$action_model = $module->model->singular_name.': '.$model->t11_name;
		$route_index = route('dashboard.'.$module->route.'.index', $protocol_id);
		$route_edit = route('dashboard.'.$module->route.'.edit', array($protocol_id, $id));
		$model_father_id = $protocol_id;

		return View::make('dashboard.pages.models.generic.show', compact('action_model', 'model', 'module', 'route_index', 'route_edit', 'model_father_id'));
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
		$annex = Annex::findOrFail($id);

		$action_model = 'Editar '.$module->model->singular_name.': '.$annex->t11_name;

		$form_data = array(
			'route' => array('dashboard.'.$module->route.'.update', $annex->id), 
			'method' => 'PUT', 
			'files' => true
		);

		$route_index = route('dashboard.'.$module->route.'.index', $protocol_id);
		return View::make('dashboard.pages.models.annex.form', compact(
				'action_model', 'annex', 'form_data', 
				'module', 'route_index', 'protocol'
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
		$annex = Annex::findOrFail($id);
        
        $data = Input::all();
        if ($annex->validAndSave($data))
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $protocol_id);
        }
        else
        {
			return Redirect::route('dashboard.'.$module->route.'.edit', $annex->id)->withInput()->withErrors($annex->errors);
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
    	$annex = Annex::findOrFail($id);
        $annex->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Protocolo "' . $annex->t11_name . '" eliminado',
                'id'      => $annex->id
            ));
        }
        else
        {
            return Redirect::route('dashboard.'.$module->route.'.index', $protocol_id);
        }
	}


}
