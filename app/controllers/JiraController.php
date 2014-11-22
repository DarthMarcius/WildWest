<?php

/**
 * JIRA REST API CONTROLLER
 */
class JiraController extends BaseController
{
    /*DECLARE DEFAULT VALUES*/
    const DEFAULT_URL = "http://jiratest.ofactory.biz/jira/rest/api/2/";
    const DEFAULT_LOGIN = "WildWestAdmin";
    const DEFAULT_PASSWORD = "G4qURwJcHD";
    const GET_PROJECT = 'project/HACKWIL';
    const GET_ISSUES = 'issues';
//    /*DECLARE PUBLIC API REQUEST NAMES*/
//    public $getProject = 'project';

    public function __construct(){

        $this->connectAuthInfo();
    }
    public function show()
    {
        $request = new \Jyggen\Curl\Request('http://jiratest.ofactory.biz/jira/rest/api/2/project');
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", "WildWestAdmin", "G4qURwJcHD"));
        $request->execute();

        $response = $request->getResponse();
        print_r(json_decode($response->getContent()->issueTypes));
//    $get = Curl::get('http://jiratest.ofactory.biz/jira/rest/api/2/project');
//    var_dump($get);
        return View::make('pages.index');
    }

    /**
     * connectAuthInfo used for setting up authentication configuration data.
     * @param $url - BASE JIRA ULR CONNECT LINK
     * @param $login - LOGIN OF JIRA USER
     * @param $password - PASSWORD OF JIRA USER
     */
    public function connectAuthInfo($url = FALSE, $login = FALSE, $password = FALSE)
    {
        if ($url===FALSE) {
            $this->url = self::DEFAULT_URL;
        } else {
            $this->url = $url;
        }
        if ($login===FALSE) {
            $this->login = self::DEFAULT_LOGIN;
        } else {
            $this->login = $login;
        }
        if ($password===FALSE) {
            $this->password = self::DEFAULT_PASSWORD;
        } else {
            $this->password = $password;

    }
    }

    /**
     * @return mixed
     * @throws \Jyggen\Curl\Exception\CurlErrorException
     * @throws \Jyggen\Curl\Exception\ProtectedOptionException
     */
    public function getProjects()
    {
        $request = new \Jyggen\Curl\Request($this->url.self::GET_PROJECT);
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
        print_r(json_decode($response->getContent()));

        return View::make('pages.index');
    }

    public function checkConnectionStatus()
    {
        $request = new \Jyggen\Curl\Request($this->url.self::GET_PROJECT);
//        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
        var_dump($response);

        return View::make('pages.index');
    }


}