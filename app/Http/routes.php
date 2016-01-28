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

// Route::post('/login', 'AuthController@login');

// Route::post('/login', 'AuthController@login');

Route::controllers([
    'auth' => '\App\Http\Controllers\Auth\AuthController',
    'password' => '\App\Http\Controllers\Auth\PasswordController',
]);

Route::get('/auth/register', ['middleware' => 'auth', 'uses' => 'AuthController@getRegister']);
// Option to 

// Route::bind('articles', function($id)
// {

// 	return \App\Article::where('id', $id)->first();

// });



// Route::get('/articles/create', 'ArticlesController@create');


// SHOWS A SPECIFIC RECORD. IE: CLICK ON A LINK AND GO TO THAT SPECIFIC THING.
// Route::get('/articles/{article}', 'ArticlesController@show');

// Route::get('/articles/{article}/edit', 'ArticlesController@edit');

// Route::patch('articles/{article}', 'ArticlesController@update');


// OLD NON BINDING WAY
// Route::get('/articles', 'ArticlesController@index');

// Route::get('/articles/{id}', 'ArticlesController@show');

// Route::get('/articles/{id}/edit', 'ArticlesController@edit');

// Route::patch('articles/{id}', 'ArticlesController@update');

// Route::get('/articles/create', 'ArticlesController@create');

// Route::post('articles', 'ArticlesController@store');

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