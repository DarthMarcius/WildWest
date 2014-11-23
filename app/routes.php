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
//add CSRF protection for all routes on POST
Route::when('*', 'csrf', array('post'));

//route to application main page
Route::group(array('before' => 'auth'), function(){
    Route::get('/', 'DashboardController@index');
	Route::get('jira/getProjects', 'JiraController@getProjects', array());
	Route::get('jira/getUsers', 'JiraController@getUsers', array());
	Route::get('jira/getUsers{projectName}', 'JiraController@getUsers', array());
	Route::get('jira/getIssues', 'JiraController@getIssues', array());
	Route::get('jira/getWorklog', 'JiraController@getWorklog', array());
	Route::get('jira/getHistory', 'JiraController@getHistory', array());
    Route::get('notificate-users', 'BaseController@doNotificate');
	Route::get('jira/getUsersActivity/{timebegin}/{timeend}', 'JiraController@getUsersActivity', array())->where(array('timebegin' =>'[0-9]+','timeend' =>'[0-9]+'));
	Route::get('jira/getUsersActivity', 'JiraController@getUsersActivity', array());
	Route::get('jira/getAllWorkLogsToIssue/{issueIdOrKey}', 'JiraController@getAllWorkLogsToIssue');
	Route::get('jira/getAllIssuesForProject/{projectName}', 'JiraController@getAllIssuesForProject');
	Route::get('jira/getAllIssuesForProject', 'JiraController@getAllIssuesForProject');
	Route::get('jira/showAllWorkLogsToProject/{projectName}', 'JiraController@showAllWorkLogsToProject');
	Route::get('jira/showAllWorkLogsToProject', 'JiraController@showAllWorkLogsToProject');
	Route::get('/jira/ajaxshowAllWorkLogsToProject', 'JiraController@ajaxshowAllWorkLogsToProject');
	Route::get('/jira/ajaxshowCountedLogs', 'JiraController@ajaxshowCountedLogs');
});

Route::any('login', 'BaseController@login');
Route::any('logout', 'BaseController@logout');
Route::controller('password', 'RemindersController'); //routes for remind and reset password
Route::resource('jira_users', 'JiraUsersController'); //CRUD routes for jira_users
Route::resource('jira_issues', 'JiraIssuesController'); //CRUD routes for jira_issues
Route::resource('jira_worklogs', 'JiraWorklogsController'); //CRUD routes for jira_worklogs
Route::resource('grace_periods', 'GracePeriodsController',
                array('only' => array('store'))); // CRUD routes for grace_periods

Route::get('/test', function()
{
	return View::make('pages.index');            
});

Route::get('/jira', 'JiraController@checkConnectionStatus');
