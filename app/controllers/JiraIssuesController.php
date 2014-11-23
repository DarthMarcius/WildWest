<?php

class JiraIssuesController extends \BaseController {

	/**
	 * Display a listing of jiraissues
	 *
	 * @return Response
	 */
	public function index()
	{
		$jiraissues = Jiraissue::all();

		return View::make('jira_issues.index', compact('jiraissues'));
	}

	/**
	 * Show the form for creating a new jiraissue
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('jiraissues.create');
	}

	/**
	 * Store a newly created jiraissue in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Jiraissue::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Jiraissue::create($data);

		return Redirect::route('jiraissues.index');
	}

	/**
	 * Display the specified jiraissue.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$jiraissue = Jiraissue::findOrFail($id);

		return View::make('jiraissues.show', compact('jiraissue'));
	}

	/**
	 * Show the form for editing the specified jiraissue.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jiraissue = Jiraissue::find($id);

		return View::make('jiraissues.edit', compact('jiraissue'));
	}

	/**
	 * Update the specified jiraissue in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$jiraissue = Jiraissue::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Jiraissue::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jiraissue->update($data);

		return Redirect::route('jiraissues.index');
	}

	/**
	 * Remove the specified jiraissue from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Jiraissue::destroy($id);

		return Redirect::route('jiraissues.index');
	}

}
