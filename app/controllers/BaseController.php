<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    
    /**
     * Show LOGIN page
     */
    public function login(){
        
        $user = 'test';//array();
        
        return View::make('pages.login', array('user' => $user));
    }

}
