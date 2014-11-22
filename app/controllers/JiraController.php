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
    const DEFAULT_PROJECT = "HACKWIL";
    const GET_PROJECT = 'project/HACKWIL';
    const SEARCH = 'search';

    public function __construct()
    {

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
        if ($url === FALSE) {
            $this->url = self::DEFAULT_URL;
        } else {
            $this->url = $url;
        }
        if ($login === FALSE) {
            $this->login = self::DEFAULT_LOGIN;
        } else {
            $this->login = $login;
        }
        if ($password === FALSE) {
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
        $request = new \Jyggen\Curl\Request($this->url . self::GET_PROJECT);
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
        print_r(json_decode($response->getContent()));

        return View::make('pages.index');
    }

    public function getUsers()
    {
        $request = new \Jyggen\Curl\Request($this->url . 'user/assignable/multiProjectSearch?projectKeys=' . self::DEFAULT_PROJECT);
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
        $usersObject = json_decode($response->getContent());
        $allUsers = array();
        foreach ($usersObject as $userObject) {
            $allUsers[] = array(
                'userId' => $userObject->name,
                'userName' => $userObject->name,
                'userEmailAddress' => $userObject->emailAddress,
                'active'    => $userObject->active
            );
        }
        var_dump($allUsers);

        return View::make('pages.index');
    }

    public function getIssues()
    {
        $request = new \Jyggen\Curl\Request($this->url . 'search?jql=project%20%3D%20' . self::DEFAULT_PROJECT);
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
//        var_dump($response);
        var_dump(json_decode($response->getContent())->issues[1]->fields);

        return View::make('pages.index');
    }

    public function getWorklog()
    {
        $request = new \Jyggen\Curl\Request($this->url . 'search?jql=project=HACKWIL&fields=worklog');
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
//        var_dump($response);
        var_dump(json_decode($response->getContent())->issues[1]->fields);

        return View::make('pages.index');
    }

    public function getHistory()
    {
        $request = new \Jyggen\Curl\Request($this->url . 'issue/HACKWIL-16?expand=changelog');
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
//        var_dump($response);
        var_dump(json_decode($response->getContent())->changelog->histories[5]);

        return View::make('pages.index');
    }

    public function getUserActivity()
    {
//        http://jiratest.ofactory.biz/jira/activity?streams=update-date+BETWEEN+1416520800000+1416607199999&streams=user+IS+WildWest2&_=1416654577838
        $request = new \Jyggen\Curl\Request('http://jiratest.ofactory.biz/jira/activity?streams=update-date+BETWEEN+1416520800000+1416607199999');
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
        $simple = $response->getContent();
        $xml = simplexml_load_string($simple);
        $json = json_encode($xml);
        var_dump(json_decode($json)->entry[4]);

        return View::make('pages.index');
    }
}