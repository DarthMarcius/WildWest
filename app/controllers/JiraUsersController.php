<?php

class JiraUsersController extends \BaseController {

	/**
	 * Display a listing of jirausers
	 *
	 * @return Response
	 */
	public function index()
	{
		$jirausers = Jirauser::all();

		return View::make('jirausers.index', compact('jirausers'));
	}

	/**
	 * Show the form for creating a new jirauser
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('jirausers.create');
	}

	/**
	 * Store a newly created jirauser in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Jirauser::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Jirauser::create($data);

		return Redirect::route('jirausers.index');
	}

	/**
	 * Display the specified jirauser.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$jirauser = Jirauser::findOrFail($id);

		return View::make('jirausers.show', compact('jirauser'));
	}

	/**
	 * Show the form for editing the specified jirauser.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jirauser = Jirauser::find($id);

		return View::make('jirausers.edit', compact('jirauser'));
	}

	/**
	 * Update the specified jirauser in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$jirauser = Jirauser::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Jirauser::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jirauser->update($data);

		return Redirect::route('jirausers.index');
	}

	/**
	 * Remove the specified jirauser from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Jirauser::destroy($id);

		return Redirect::route('jirausers.index');
	}

}
