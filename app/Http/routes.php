<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Route::get('/about', function()
{
	return View::make('about');
	
});

Route::get('/alldeals', 'ArticlesController@showall');


Route::controllers([
    'auth' => '\App\Http\Controllers\Auth\AuthController',
    'password' => '\App\Http\Controllers\Auth\PasswordController',
]);

Route::get('/auth/register', ['middleware' => 'auth', 'uses' => 'AuthController@getRegister']);

function photo_path()
{

	return public_path() . '/images/';

}

// RESOURCE OPTION

Route::resource('articles', 'ArticlesController', [

	'names' => [

		'index' => 'articles_path',
		'show' => 'article_path',
		'edit' => 'articleEdit_path',
		'update' => 'articleUpdate_path',
		'create' => 'articleCreate_path',
		'store' => 'articleStore_path',
		'destory' => 'articleDestroy_path'
	]

	]);
