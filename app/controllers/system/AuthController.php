<?php  

class AuthController extends BaseController {
 
 	public function getLogin()
 	{
 		if (Auth::check())
        {
            return Redirect::to('/');
        }
        else
        {
        	return View::make('auth/login');
        }

 	}

	public function postLogin()
	{
		$userdata = Input::only('username','password');
		$userdata['username'] = trim($userdata['username']);
		$remember = Input::get('remember');

		if(Auth::attempt($userdata, $remember))
		{
			Session::put('actual_company', Auth::user()->preferredCompany);
			return Redirect::intended('/');
		}
		else
		{	
			return Redirect::to('login')->with('error', 'Datos invalidos, verifique su nombre de usuario y contraseña')->withInput();
		}
	}
		 
	public Function getLogout()
	{
		Session::flush(); 
        Auth::logout();  
        return Redirect::to('login')->with('success', 'Ha cerrado la sesión satisfactoriamente.'); 
	}
}