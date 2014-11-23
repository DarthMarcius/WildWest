<?php

class GracePeriodsController extends \BaseController {

	/**
	 * Display a listing of graceperiods
	 *
	 * @return Response
	 */
	public function index()
	{
		$graceperiods = Graceperiod::all();

		return View::make('graceperiods.index', compact('graceperiods'));
	}

	/**
	 * Show the form for creating a new graceperiod
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('graceperiods.create');
	}

	/**
	 * Store a newly created graceperiod in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Graceperiod::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Graceperiod::create($data);

		return Redirect::route('graceperiods.index');
	}

	/**
	 * Display the specified graceperiod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$graceperiod = Graceperiod::findOrFail($id);

		return View::make('graceperiods.show', compact('graceperiod'));
	}

	/**
	 * Show the form for editing the specified graceperiod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$graceperiod = Graceperiod::find($id);

		return View::make('graceperiods.edit', compact('graceperiod'));
	}

	/**
	 * Update the specified graceperiod in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$graceperiod = Graceperiod::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Graceperiod::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$graceperiod->update($data);

		return Redirect::route('graceperiods.index');
	}

	/**
	 * Remove the specified graceperiod from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Graceperiod::destroy($id);

		return Redirect::route('graceperiods.index');
	}

}
