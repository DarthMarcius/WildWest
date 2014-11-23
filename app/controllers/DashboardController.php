<?php

class DashboardController extends Controller {

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
     * Main paige of dashboard.
     */
    public function index(){
        //get grace period form DB, if exists show it in view
        $gp = Graceperiod::first();
        //add here data which we can render in view
        $dataToView = array(
            'grace_settings' => $gp ? $gp->days.'d '.$gp->hours.'h '.$gp->minutes.'m' : null
        );
                
        return View::make('dashboard.index', $dataToView);
    }
    
    /**
     * Check our DB and return user validation result.
     */
    public function checkLogin(){
        //return validation to AJAX request
        return TRUE;
    }
    
    /**
     * Check user by JIRA API and return Validation result.
     */
    public function checkJIRAUser(){
        //return validation to AJAX request
        return TRUE;
    }

}
