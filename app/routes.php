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

Route::get('login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));	

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



Route::group(array('before' => 'auth'), function()
{	
	Route::post('actualizar-perfil/{user}', array('as' => 'usuarios.update-profile', 'uses' => 'UsersController@updateProfile'));
	Route::get('mi-perfil', array('as' => 'usuarios.show-profile', 'uses' => 'UsersController@profile'));
	/***** Only acces Role 1 => Super Admin *****/
	Route::group(array('before' => 'system_roles:1'), function()
	{
		Route::resource('instituciones', 'CompaniesController');
		Route::resource('instituciones.usuarios', 'CompaniesUsersController');
	});

	/***** Only acces Roles 2=> Admin *****/
	Route::group(array('before' => 'system_roles:2'), function()
	{
		Route::resource('areas', 'AreasController');
		Route::resource('usuarios/perfiles', 'UserRolesController');
		Route::get('usuarios/{user}/calificaciones', array('as' => 'usuarios.calificaciones', 'uses' => 'UsersController@scores'));
		Route::resource('usuarios', 'UsersController');
		
		
		Route::resource('protocolos/categorias', 'ProtocolCategoriesController');
		Route::get('protocolos/{protocol}/estadisticas', array('as' => 'protocolos.estadisticas', 'uses' => 'ProtocolsController@stats'));
		Route::resource('protocolos', 'ProtocolsController');
		Route::resource('protocolos.anexos', 'AnnexController');
		Route::resource('protocolos.enlaces', 'LinksController');
		Route::resource('protocolos.preguntas', 'QuestionsController');
		Route::resource('formularios', 'SurveysController');
		Route::resource('formularios.preguntas', 'SurveysQuestionsController');
	});

	/***** Only acces Roles 3=> Registrered *****/
	Route::group(array('before' => 'system_roles:3'), function()
	{
		Route::get('mis-formularios', array('as' => 'formularios.listscanacces', 'uses' => 'SurveysController@listsCanAccess'));
		Route::get('formularios/{survey}/registros/{resolvedSurvey}/descargar', array('as' => 'formularios.registros.export', 'uses' => 'ResolvedSurveysController@export'));
		Route::get('formularios/{survey}/registros/{resolvedSurvey}/enviar', array('as' => 'formularios.registros.send', 'uses' => 'ResolvedSurveysController@send'));
		Route::resource('formularios.registros', 'ResolvedSurveysController');
		Route::get('estudiar/{protocol}', array('as' => 'estudiar', 'uses' => 'ExamsController@studyProtocol'));
		Route::get('examenes/presentar/{protocol}', array('as' => 'examenes.create', 'uses' => 'ExamsController@create'));
		Route::post('examenes/presentar/{protocol}', array('as' => 'examenes.store', 'uses' => 'ExamsController@store'));
	});
	
	/***** Acces All Roles *****/
	Route::controller('/', 'DashboardController');


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
