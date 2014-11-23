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
     * Show LOGIN page and login user if passed name|pass are right
     * We will have three users at the moment(username|password):
     * user|test
     * admin|test
     * super-admin|test
     * 
     * @return void
     */
    public function login(){
        if( Auth::check() ){
            //redirect to previous page or to homepage when user is already logged in
            return Redirect::to('/');
        }
        $username = Input::get('name');
        $password = Input::get('password');
        if( $username && $password ){
            //validate form data
            if (Auth::attempt(array('username' => $username, 'password' => $password)))
            {
                //redirect to homepage
                return Redirect::to('/');
            }
            Session::flash('error', 'Your username or password is invalid. Please try another one.');
        }
        //pass to view entered|default values
        $visitor_data = array(
            'name' => $username
        );
        
        return View::make('pages.login', array('visitor_data' => $visitor_data));
    }
    
    /**
     * Do user logout. Redirect to Login page.
     * @return void
     */
    public function logout(){
        Auth::logout();
        return Redirect::to('/login');
    }
    
    /**
     * Send messages to Users
     * 
     * @return void
     */
    public function doNotificate(){
        //build mail body
        $userData = array(
            'project_name'  => 'HackathonWildWest',
            'pm_name'       => 'Sorin',
            'pm_surname'    => 'Chircu',
            'user_name'     => 'WildWest1',
            'missed_amount' => '2h', //can be in format "2h 30m"
            'missed_date'   => 'Monday 17 November' //eg: on Monday 17 November
            );
        //Mail::pretend();
        Mail::send('emails.user_notification', $userData, function($message)
        {
            $message->to('andriy.leshchuk@osf-global.com', 'WildWest1')->subject('Missed hours on JIRA!');
        });
        return 'Notification successfully sent.';
    }
}
