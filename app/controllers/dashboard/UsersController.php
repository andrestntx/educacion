<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$users = Auth::user()->preferredCompany->users()->where('system_role_id', '<>', 2)->orderBy('id')->paginate(20);

		return View::make('dashboard.pages.user.lists-table', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = new User;

		$roles = Auth::user()->preferredCompany->roles()->lists('name', 'id');
		$areas = Auth::user()->preferredCompany->areas()->lists('name', 'id');
		
		$system_roles = SystemRole::lists('name', 'id');
		
		$form_data = array('route' => 'usuarios.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.user.form', compact(
			 'user', 'form_data', 'roles', 'areas'
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $company = new User;
        $data = Input::all();
        $data['preferred_company_id'] = Auth::user()->preferredCompany->id;
        $data['system_role_id'] = 3; 

        if ($company->validAndSave($data))
        {
        	$company->syncCompanies(array(Auth::user()->preferredCompany->id));
            return Redirect::route('usuarios.index');
        }
        else
        {
			return Redirect::route('usuarios.create')->withInput()->withErrors($company->errors);
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
		$user = User::findOrFail($id);

		return View::make('dashboard.pages.user.show', compact('user'));

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);

		$roles = Auth::user()->preferredCompany->roles()->lists('name', 'id');
		$areas = Auth::user()->preferredCompany->areas()->lists('name', 'id');

		$form_data = array(
			'route' => array('usuarios.update', $user->id), 
			'method' => 'PUT', 
			'files' => true
		);

		return View::make('dashboard.pages.user.form', compact(
				'user', 'form_data', 'roles', 'areas'
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
		$user = User::findOrFail($id);
        
        $data = Input::all();

        if ($user->validAndSave($data))
        {
            return Redirect::route('usuarios.index');
        }
        else
        {
			return Redirect::route('usuarios.edit', $user->id)->withInput()->withErrors($user->errors);
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
    	$user = User::findOrFail($id);
        $user->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Usuario "' . $user->name . '" eliminado',
                'id'      => $user->id
            ));
        }
        else
        {
            return Redirect::route('usuarios.index');
        }
	}

	public function updateProfile($id)
	{
		$user = User::findOrFail($id);
        
        $data = Input::all();

        if ($user->validAndSave($data))
        {
            return Redirect::to('/');
        }
        else
        {
        	return Redirect::intended('/')->withErrors($user->errors);
        }	
	}
}
