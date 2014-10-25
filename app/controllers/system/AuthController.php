<?php  

class AuthController extends BaseController {
 
 	public function getLogin()
 	{
 		if (Auth::check())
        {
            return Redirect::to('dashboard');
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

		if(Auth::attempt($userdata))
		{
			return Redirect::intended('dashboard');
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