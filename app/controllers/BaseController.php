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
--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permission`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', '$2y$10$wSISk38mPVOsO6EXdqSzDOFGE.TngJxoQJ9eMXhVoDf0r9ivgR.gq', 0, 'V7S8II8NXI8dFdr0J3CEDQ6VdUpLKnj7APbMN2WXMlJv6bFyRSGmA9zMKiyn', '0000-00-00 00:00:00', '2014-11-22 11:55:30'),
(3, 'admin', '$2y$10$wSISk38mPVOsO6EXdqSzDOFGE.TngJxoQJ9eMXhVoDf0r9ivgR.gq', 0, 'UtqKRGWGs3cfBBEfOwjT4YbPUJn09NznRTzmFqqqzfe7CJSJguCHrJP5MY1K', '0000-00-00 00:00:00', '2014-11-22 11:55:42'),
(4, 'super-admin', '$2y$10$wSISk38mPVOsO6EXdqSzDOFGE.TngJxoQJ9eMXhVoDf0r9ivgR.gq', 0, 'uePyKm57R3BALHiTHUJP1wMog16HPNEwDlq4UwOTfIzQdg6yVkW10ql9NBoO', '0000-00-00 00:00:00', '2014-11-22 11:56:00');

     * 
     * @return void
     */
    public function login(){
        if( Auth::check() ){
            //redirect to previous page or to homepage when user is already logged in
            return Redirect::to('/');
        }
        $email = Input::get('name');
        $password = Input::get('password');
        if( $email && $password ){
            //validate form data
            if (Auth::attempt(array('email' => $email, 'password' => $password)))
            {
                //redirect to homepage
                return Redirect::to('/');
            }
            Session::flash('error', 'Your username or password is invalid. Please try another one.');
        }
        //pass to view entered|default values
        $visitor_data = array(
            'name' => $email
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
        
        return 'Notification successfully sent.';
    }
}
