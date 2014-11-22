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
        $email = Input::get('name');
        $password = Input::get('password');
            
        if( $email && $password ){
            //validate form data
            
            if (Auth::attempt(array('email' => $email, 'password' => $password)))
            {
                return Redirect::intended('dashboard');
            }
            
        }
        
        $user = 'test';//array();
        
        return View::make('pages.login', array('user' => $user));
    }
    
    public function checkLogin(){
        
    }

}
