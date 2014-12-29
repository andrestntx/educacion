<?php

class CompaniesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$companies = Company::whereTypeId('2')->orderBy('id')->paginate(10);
		return View::make('dashboard.pages.company.lists', compact('companies'));
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$company = new Company;
		$type_id = 2;
		$form_data = array('route' => 'instituciones.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.company.form', compact('company', 'form_data', 'type_id'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $company = new Company;
        $data = Input::all();
        $image = Input::file('url_logo');

        if ($company->validAndSave($data, $image))
        {
        	$company->createDefaultData();
            return Redirect::route('instituciones.index');
        }
        else
        {
			return Redirect::route('instituciones.create')->withInput()->withErrors($company->errors);
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
		$company = Company::findOrFail($id);

		return View::make('dashboard.pages.company.show', compact('company'));

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
		$type_id = 2;
		$form_data = array('route' => array('instituciones.update', $company->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.company.form', compact('company', 'form_data', 'type_id'));
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
        $data = Input::all();
        $image = Input::file('url_logo');

        if ($company->validAndSave($data, $image))
        {
            return Redirect::route('instituciones.index');
        }
        else
        {
			return Redirect::route('instituciones.edit', $company->id)->withInput()->withErrors($company->errors);
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
    	try {
    		$company->delete();
    		$result = array('success' => true, 'msg' => 'Institución "' . $company->name . '" eliminada', 'id' => $company->id);
    	} catch (Exception $e) {
    		$result = array('success' => false, 'msg' => 'La Institución no se puede eliminar', 'id' => $company->id);
    	}
   

        if (Request::ajax())
        {
            return Response::json($result);
        }
        else
        {
            return Redirect::route('instituciones.index');
        }
	}
}
