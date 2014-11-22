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
        $dataToView = array(); //add here data which we can render in view
        
        
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
