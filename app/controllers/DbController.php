<?php

class DbController extends BaseController {

	/**
         * Test DB connection. Select simple data
         */
	public function showTest()
	{
            $results = DB::table('users')->get();
            //$results = DB::select('select * from users', array(1));
            
            return $results;
            
            //return View::make('hello');
	}

}
