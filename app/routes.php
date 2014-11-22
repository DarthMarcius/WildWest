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

//route to application main page
Route::group(array('before' => 'auth'), function(){
    Route::get('/', 'DashboardController@index');
});

Route::any('login', 'BaseController@login');

Route::get('dashboard', 'DashboardController@index');
/*
Route::get('/', function()
{
	return View::make('pages.index');            
});

Route::get('login', function()
{
	return View::make('pages.login');            
});
*/
Route::get('db_test', 'DbController@showTest');

Route::get('/test', function()
{
	return View::make('pages.index');            
});