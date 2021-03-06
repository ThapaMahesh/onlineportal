<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function(){
	return redirect('auth/login');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::get('auth/logout', 'Auth\AuthController@logout');
Route::group(['middleware' => ['web']], function () {
   	Route::controllers([
		'auth' => 'Auth\AuthController'
	]);	
});

Route::group(['middleware' => ['web', 'auth']], function () {
	    Route::controllers([

			'admin' 	=> 'AdminController',	
			'file' 		=>'FileController',
			'forum' 	=> 'ForumController',
			'profile'	=> 'ProfileController',
			'student' 	=> 'StudentController'
		]);
	Route::get('auth/logout', 'Auth\AuthController@logout');	
	});
