<?php

class GracePeriodsController extends \BaseController {

	/**
	 * Display a listing of graceperiods
	 *
	 * @return Response
	 */
	public function index()
	{
		$graceperiods = GracePeriod::all();

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
		$validator = Validator::make($data = Input::only('days', 'minutes', 'hours'), GracePeriod::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//Graceperiod::create($data);
                $gracePeriod = GracePeriod::first();
                if($gracePeriod){
                    //do update existing entry
                    $gracePeriod->update($data);
                } else {
                    //create new
                    GracePeriod::create($data);
                }
                
		return Redirect::to('/');
	}

	/**
	 * Display the specified graceperiod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$graceperiod = GracePeriod::findOrFail($id);

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
		$graceperiod = GracePeriod::find($id);

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
		$graceperiod = GracePeriod::findOrFail($id);

		$validator = Validator::make($data = Input::all(), GracePeriod::$rules);

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
		GracePeriod::destroy($id);

		return Redirect::route('graceperiods.index');
	}

}
