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
//add CSRF protection for all routes
Route::when('*', 'csrf', array('post'));

//route to application main page
Route::group(array('before' => 'auth'), function(){
    Route::get('/', 'DashboardController@index');
	Route::get('jira/getProjects', 'JiraController@getProjects', array());
	Route::get('jira/getUsers', 'JiraController@getUsers', array());
	Route::get('jira/getIssues', 'JiraController@getIssues', array());
	Route::get('jira/getWorklog', 'JiraController@getWorklog', array());
	Route::get('jira/getHistory', 'JiraController@getHistory', array());
	Route::get('jira/getUserActivity', 'JiraController@getUserActivity', array());
});

Route::any('login', 'BaseController@login');
Route::any('logout', 'BaseController@logout');

/*
Route::get('/', function()
{
	return View::make('pages.index');            
});
*/
Route::get('db_test', 'DbController@showTest');


Route::get('/test', function()
{
	return View::make('pages.index');            
});

//Route::get('/jira', 'JiraController@getUsers');
