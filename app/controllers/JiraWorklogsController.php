<?php

class JiraWorklogsController extends \BaseController {

	/**
	 * Display a listing of jiraworklogs
	 *
	 * @return Response
	 */
	public function index()
	{
		$jiraworklogs = Jiraworklog::all();

		return View::make('jiraworklogs.index', compact('jiraworklogs'));
	}

	/**
	 * Show the form for creating a new jiraworklog
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('jiraworklogs.create');
	}

	/**
	 * Store a newly created jiraworklog in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Jiraworklog::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Jiraworklog::create($data);

		return Redirect::route('jiraworklogs.index');
	}

	/**
	 * Display the specified jiraworklog.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$jiraworklog = Jiraworklog::findOrFail($id);

		return View::make('jiraworklogs.show', compact('jiraworklog'));
	}

	/**
	 * Show the form for editing the specified jiraworklog.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jiraworklog = Jiraworklog::find($id);

		return View::make('jiraworklogs.edit', compact('jiraworklog'));
	}

	/**
	 * Update the specified jiraworklog in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$jiraworklog = Jiraworklog::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Jiraworklog::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jiraworklog->update($data);

		return Redirect::route('jiraworklogs.index');
	}

	/**
	 * Remove the specified jiraworklog from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Jiraworklog::destroy($id);

		return Redirect::route('jiraworklogs.index');
	}

}
