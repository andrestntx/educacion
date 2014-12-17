<?php

class CompaniesUsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index($company_id)
	{
		$company = Company::findOrFail($company_id);
		$users = $company->users()->admin()->orderBy('id')->get();
		return View::make('dashboard.pages.user.lists-table-superadmin', compact('company', 'users')); 
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($company_id)
	{
		Company::findOrFail($company_id);
		$user = new User;
		$form_data = array('route' => array('instituciones.usuarios.store', $company_id), 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.user.form', compact('user', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($company_id)
	{
        $user = new User;
        $data = Input::all();
        $image = Input::file('url_photo');
        $data['preferred_company_id'] = $company_id;
        $data['system_role_id'] = 2; 

        if ($user->validAndSave($data, $image))
        {
        	$user->syncCompanies(array($company_id));
            return Redirect::route('instituciones.usuarios.index', $company_id);
        }
        else
        {
			return Redirect::route('instituciones.usuarios.create', $company_id)->withInput()->withErrors($user->errors);
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
		$user = User::findOrFail($id);

		return View::make('dashboard.pages.user..show', compact('user'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($company_id, $id)
	{
		$user = Company::findOrFail($company_id)->users()->findOrFail($id);

		$form_data = array(
			'route' => array('instituciones.usuarios.update', $company_id, $user->id), 
			'method' => 'PUT', 
			'files' => true
		);
		return View::make('dashboard.pages.user.form', compact(
				'user', 'form_data'
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
		$user = User::findOrFail($id);
        $data = Input::all();
        $image = Input::file('url_photo');
        
        if ($user->validAndSave($data, $image))
        {
            return Redirect::route('instituciones.usuarios.index', $company_id);
        }
        else
        {
			return Redirect::route('instituciones.usuarios.edit', array($company_id, $user->id))->withInput()->withErrors($user->errors);
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
    	$user = User::findOrFail($id);
        try {
        	$user->delete();
        	$result = array('success' => true, 'msg'     => 'Usuario "' . $user->name . '" eliminado', 'id'      => $user->id);
        } catch (Exception $e) {
        	$result = array('success' => false, 'msg' => $e->getMessage(), 'id' => $user->id);
        }
        

        if (Request::ajax())
        {
            return Response::json($result);
        }
        else
        {
            return Redirect::route('instituciones.usuarios.index', $company_id);
        }
	}


}
