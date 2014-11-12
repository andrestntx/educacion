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
		/***** Only acces Role 1 => Super Admin *****/
		Route::group(array('before' => 'system_roles:1'), function()
		{
			Route::group(array('prefix' => 'config'), function() 
			{
				Route::resource('models', 'GlobalModelController', array('only' => array('index', 'show', 'edit', 'update')));
			});

			/***** Component Management Company *****/
			//Route::resource('companies', 'CompaniesController'); //Company
			//Route::resource('companies.users', 'CompaniesUsersController'); //Company Users

			Route::resource('companies', 'CompaniesController');
			Route::resource('companies.users', 'UsersController');

			// To Future
			// Users [Eloquent] |Dependence: ToMayCompanies| |Dependence: ToMayRoles|

		});

		/***** Only acces Roles 1 => Super Admin && 2=> Admin *****/
		Route::group(array('before' => 'system_roles:1-2'), function()
		{
			Route::resource('users', 'UsersController');
			Route::resource('protocols', 'ProtocolsController');
			//Route::resource('users', 'UsersController'); //Auth Company Users

			//Auth Company 'Config' Exams [show: ver detalle, edit: cambiar configuracion, update: actualizar información]
	
			//Auth Company, Roles [Eloquent]
			//Auth Company, Roles {Role} Protocols [index: ver lista, redirectTo: Eloquent]
			//Auth Company, Users [Eloquent] |Dependence: ToManyRoles| 

			//Auth Company, Areas [Eloquent] |Dependence: ToUser creater|
			//Auth Company, Areas {Area} Protocols [index: ver lista, redirecTo: Eloquent] 
			//Auth Company, Areas {Area} Protocols {Protocol} Exams [index: ver lista, show: redirectTo: show(user,protocol,exam)]
						
			//Auth Company, Protocols [index: ver lista, show: redirectTo Eloquent]  
			//Auth Company, Users {User(ower)} Protocols [Eloquent] |Dependence: ToMayCategories| |Dependence: ToMayAreas| |Dependence: ToMayRoles| |Dependence: ToMayAnex| 
			//Auth Company, Users {User(ower)} Protocols {Protocol} Anex [Eloquent]
			//Auth Company, Users {User(ower)} Protocols {Protocol} Questions [Eloquent] |Dependence: ToMayAreas|
			//Auth Company, Users {User(ower)} Protocols {Protocol} Questions {Question} Answer [Eloquent] 
			//Auth Company, Users {User(ower)} Protocols created Exams [index: ver lista, show: redirectTo: show(user,protocol,exam)]
			
			//Auth Company, Users {User(ower)} QualityQuestions [Eloquent]
			//Auth Company, Users {User(ower)} QualityQuestions {QualityQuestion} Answers [Eloquent]

			//Auth Company, Exams [index: ver lista, redirecTo: show(user, protocol, exam)]
			//Auth Company, Users {User} Protocols exam {Protocol} Exams [index: ver lista, show: ver detalle]

			// To future
			//Auth Company, Categories [Eloquent]
			//Auth Company, Categories {Category} Protocols [Eloquent]

		});

		/***** Acces All Roles *****/
		Route::controller('/', 'DashboardController');

		//Route::resource('protocols', 'ProtocolsController');
		//Route::resource('companies.protocols', 'ProtocolsController');
		//Auth Company User(ower), Protocols [Eloquent] |Dependence: ToMayCategories| |Dependence: ToMayAreas| |Dependence: ToMayRoles| |Dependence: ToMayAnex| 
		//Auth Company User(ower), Protocols {Protocol} Anex [Eloquent]
		//Auth Company User(ower), Protocols {Protocol} Questions [Eloquent] |Dependence: ToMayAreas|
		//Auth Company User(ower), Protocols {Protocol} Questions {Question} Answer [Eloquent] 

		//Auth Company User(ower), QualityQuestions [Eloquent]
		//Auth Company User(ower), QualityQuestions {QualityQuestion} Answers [Eloquent]
		//Auth Company, Protocols {Protocol} Exam [index: ver lista, crete: presentar, store: guardar, show: ver detalle] |Dependence: ToMayQuestions/Answer| |Dependence: ToMayQualityQuestions/Answer|
		
		//Auth Company, Protocols
		
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