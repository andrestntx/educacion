<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('dashboard');
});

App::missing(function($exception)
{
	if(Auth::check())
	{
		return Response::view('dashboard/pages/404', array(), 404);
	}
	else
	{
		return Response::view('auth/404', array(), 404);
	}
	
});

Route::get('login', 'AuthController@getLogin');

Route::group(array('before' => 'auth'), function()
{
	Route::group(array('prefix' => 'dashboard'), function() 
	{
		Route::get('/', function()
		{
			return View::make('dashboard/pages/timeline');
		});
		Route::get('lock', function()
		{
			return View::make('dashboard/lock');
		});

		Route::resource('companies', 'CompaniesController');
		Route::resource('users', 'UsersController');
	});
});

Route::group(array('prefix' => 'api'), function() 
{
	Route::group(array('prefix' => 'auth'), function() 
	{
		Route::post('login', 'AuthController@postLogin');
		Route::group(array('before' => 'auth'), function()
		{
			Route::get('logout', 'AuthController@getLogout');
		});
	});
});



