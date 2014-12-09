<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

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

Route::group(array('before' => 'auth'), function()
{
		
	Route::group(array('prefix' => 'dashboard'), function() 
	{
		Route::resource('companies', 'CompaniesController');
		Route::resource('companies.users', 'CompaniesUsersController');


		/***** Only acces Role 1 => Super Admin *****/
		Route::group(array('before' => 'system_roles:1'), function()
		{
			Route::group(array('prefix' => 'config'), function() 
			{
				Route::resource('models', 'GlobalModelController', array('only' => array('index', 'show', 'edit', 'update')));
			});
		});

		/***** Only acces Roles 2=> Admin *****/
		Route::group(array('before' => 'system_roles:2'), function()
		{
			Route::resource('areas', 'AreasController');
			Route::resource('users', 'UsersController');
			Route::resource('roles', 'UserRolesController');
			
			Route::resource('protocols/categories', 'ProtocolCategoriesController');
			Route::resource('protocols', 'ProtocolsController');
			Route::resource('protocols.annex', 'AnnexController');
			Route::resource('protocols.questions', 'QuestionsController');
		});

		/***** Only acces Roles 2=> Registrered *****/
		Route::group(array('before' => 'system_roles:3'), function()
		{
			Route::get('estudiar/{protocol}', array('as' => 'dashboard.study', 'uses' => 'ExamsController@studyProtocol'));
			Route::get('examenes/{protocol}', array('as' => 'dashboard.exams', 'uses' => 'ExamsController@showExams'));
			Route::get('examenes/presentar/{protocol}/', array('as' => 'dashboard.exams.create', 'uses' => 'ExamsController@create'));
			Route::post('examenes/presentar/{protocol}/', array('as' => 'dashboard.exams.store', 'uses' => 'ExamsController@store'));
		});
		
		/***** Acces All Roles *****/
		Route::controller('/', 'DashboardController');
		
	});
});


/***** Auth *****/
Route::get('login', 'AuthController@getLogin');

/***** Routes Api REST *****/
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

/***** Routes Errors *****/

App::error(function(ModelNotFoundException $e)
{
    return Response::view('dashboard/pages/404', array(), 404);
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
