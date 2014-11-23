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
     * @param $request rest/api/2/ REQUEST COMMAND FROM https://docs.atlassian.com/jira/REST/latest/
     * @return array RETURN RESPONSE ARRAY WHAT CAN BE DECODED IN JSON
     * @throws \Jyggen\Curl\Exception\CurlErrorException
     * @throws \Jyggen\Curl\Exception\ProtectedOptionException
     */
    public function _getResponse($request)
    {
        $request = new \Jyggen\Curl\Request($this->url . $request);
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        return $request->getResponse();
    }

    /**
     * @return mixed
     * @throws \Jyggen\Curl\Exception\CurlErrorException
     * @throws \Jyggen\Curl\Exception\ProtectedOptionException
     */
    public function getProjects()
    {
        $response = $this->_getResponse(self::GET_PROJECT);

        var_dump(json_decode($response->getContent()));

        return View::make('pages.index');
    }

    /**
     * GET ALL ISSUES TO CURRENT PROJECT
     * @param bool $projectName
     * @return array ARRAY OF ISSUES WITH INFO
     */
    public function getAllIssuesForProject($projectName = FALSE)
    {
        if ($projectName === FALSE) {
            $projectName = self::DEFAULT_PROJECT;
        }
        $response = $this->_getResponse('search?jql=project%20%3D%20' . $projectName . '&maxResults=-1');
        $objects = json_decode($response->getContent());
        $allIssues = array();
        foreach ($objects->issues as $object) {
            $allIssues[] = array(
                'issueId' => $object->id,
                'issueKey' => $object->key,
                'issueName' => $object->fields->summary,
                'issueDescription' => $object->fields->description,
                'statusName' => $object->fields->status->name,
                'projectName' => $projectName
            );
        }

        return $allIssues;
    }

    /**
     *  ALL USERS TO PROJECT
     * @return array OF ALL USERS ASSIGNED TO THE PROJECT
     * @throws \Jyggen\Curl\Exception\CurlErrorException
     * @throws \Jyggen\Curl\Exception\ProtectedOptionException
     */
    public function getUsers($projectName = FALSE)
    {
        if ($projectName === FALSE) {
            $projectName = self::DEFAULT_PROJECT;
        }
        $response = $this->_getResponse('user/assignable/multiProjectSearch?projectKeys=' . $projectName);
        $objects = json_decode($response->getContent());
        $allUsers = array();
        foreach ($objects as $object) {
            foreach ($object->avatarUrls as $avatar) {
                $avatarUrl = $avatar;
            }
            $allUsers[] = array(
                'userId' => $object->name,
                'userName' => $object->name,
                'userEmailAddress' => $object->emailAddress,
                'userAvatarUrl' => $avatarUrl,
                'projectName' => $projectName,
                'active' => $object->active
            );
        }

        return $allUsers;
    }

    /**
     * GETTING ALL WORKLOGS RELATED TO CURRENT ISSUE
     * @param $issueIdOrKey CURRENT ISSUE ID OR KEY
     * @return mixed
     * @throws \Jyggen\Curl\Exception\CurlErrorException
     * @throws \Jyggen\Curl\Exception\ProtectedOptionException
     */
    public function getAllWorkLogsToIssue($issueIdOrKey)
    {
        $response = $this->_getResponse('issue/' . $issueIdOrKey . '/?expand=changelog');
        $objects = json_decode($response->getContent());
        $allWorkLogs = array();
//        var_dump($objects);
        $projectName = $objects->fields->project->key;
        $issueName = $objects->fields->summary;
        $issueIconUrl = $objects->fields->issuetype->iconUrl;
        $objects = $objects->fields->worklog;
        foreach ($objects as $worklogs) {
            if (is_array($worklogs)) {
                foreach ($worklogs as $worklog) {
                    $allWorkLogs[] = array(
                        'userName' => $worklog->author->name,
                        'userComment' => $worklog->comment,
                        'logDate' => $worklog->started,
                        'logTimeInSeconds' => $worklog->timeSpentSeconds,
                        'issueIdOrKey' => $issueIdOrKey,
                        'issueName' => $issueName,
                        'issueiconUrl' => $issueIconUrl,
                        'projectName' => $projectName
                    );
                }
            }
        }

        return $allWorkLogs;
    }

    /**
     * RETURN ALL LOGS TO CURREN PROJECT
     * @param bool $projectName ПОПРАЦЮВАТИ НАД ЦИМ
     */
    public function showAllWorkLogsToProject($projectName = FALSE)
    {

        if ($projectName === FALSE) {
            $projectName = self::DEFAULT_PROJECT;
        }
        $allIssuesForProject = $this->getAllIssuesForProject($projectName);
        foreach ($allIssuesForProject as $issueProject) {
            $workLog = $this->getAllWorkLogsToIssue($issueProject['issueKey']);
            if (!empty($workLog)) {
                $allWorkLogs[] = $workLog;
            }
        }
        foreach ($allWorkLogs as $workLogs) {
            foreach ($workLogs as $workLog) {
                foreach ($workLogs as $workLogInLoop) {
                    if ($workLogInLoop['userName'] == $workLog['userName'] && $workLogInLoop['logDate'] == $workLog['logDate']) {
                        $workLogArray[$workLog['userName']]['worklogs'][] = array(
                            'userName' => $workLogInLoop['userName'],
                            'issueIdOrKey' => $workLogInLoop['issueIdOrKey'],
                            'issueName' => $workLogInLoop['issueName'],
                            'userComment' => $workLogInLoop['userComment'],
                            'issueiconUrl' => $workLogInLoop['issueiconUrl'],
                            'logDate' => $workLogInLoop['logDate'],
                            'logTimeInSeconds' => $workLogInLoop['logTimeInSeconds'],
                            'projectName' => $workLogInLoop['projectName']
                        );
                    }
                }
            }
        }

        return $workLogArray;
    }

    /**
     * @return mixed RETURN ARRAY FOR AJAX CALL
     */
    public function ajaxshowAllWorkLogsToProject()
    {
        if(Request::ajax()) {
            return $this->showAllWorkLogsToProject();
        }
    }

    /**
     * @return array RETURN ARRAY FOR AJAX CALL WITH COUNTED DATA
     */
    public function ajaxshowCountedLogs()
    {
        if(Request::ajax()) {
            $allIssuesForProject = $this->getAllIssuesForProject();
            foreach ($allIssuesForProject as $issueProject) {
                $workLog = $this->getAllWorkLogsToIssue($issueProject['issueKey']);
                if (!empty($workLog)) {
                    $allWorkLogs[] = $workLog;
                }
            }
            $workLogArray = array();
            foreach ($allWorkLogs as $workLogs) {
                foreach ($workLogs as $workLog) {
                    foreach ($workLogs as $workLogInLoop) {
                        $date = explode('T', $workLogInLoop['logDate'])[0];
                        if ($workLogInLoop['userName'] == $workLog['userName'] && $workLogInLoop['logDate'] == $workLog['logDate']) {
                            $workLogArray[$workLog['userName']]['userName'] = $workLogInLoop['userName'];
                            $workLogArray[$workLog['userName']]['worklogs']["$date"] = array(
                                'logDate' => $date
                            );
                        }
                    }
                }
            }
            foreach ($allWorkLogs as $workLogs) {
                foreach ($workLogs as $workLog) {
                    foreach ($workLogs as $workLogInLoop) {
                        $date = explode('T', $workLogInLoop['logDate'])[0];
                        if ($workLogInLoop['userName'] == $workLog['userName'] && $workLogInLoop['logDate'] == $workLog['logDate']) {
                            $workLogArray[$workLog['userName']]['userName'] = $workLogInLoop['userName'];
                            if(!isset($workLogArray[$workLog['userName']]['worklogs']["$date"]['logTimeInSeconds'])) {
                                $workLogArray[$workLog['userName']]['worklogs']["$date"]['logTimeInSeconds'] = 0;
                            }
                            $workLogArray[$workLog['userName']]['worklogs']["$date"]['logTimeInSeconds'] = $workLogArray[$workLog['userName']]['worklogs']["$date"]['logTimeInSeconds']+$workLogInLoop['logTimeInSeconds'];
                            $workLogArray[$workLog['userName']]['worklogs']["$date"] += array(
                                'logTimeInSeconds' => $workLogArray[$workLog['userName']]['worklogs']["$date"]['logTimeInSeconds']
                            );
                        }
                    }
                }
            }

            return $workLogArray;
        }
    }
    /**
     * @return mixed
     * @throws \Jyggen\Curl\Exception\CurlErrorException
     * @throws \Jyggen\Curl\Exception\ProtectedOptionException
     */
    public function getWorklog()
    {
        $request = new \Jyggen\Curl\Request($this->url . 'search?jql=project=HACKWIL&maxResults=-1&fields=worklog');
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
        $usersObject = json_decode($response->getContent());
//        var_dump($usersObject); die;
        $allWorkLogs = array();
        foreach ($usersObject->issues as $userObject) {
            var_dump($userObject->fields->worklog->worklogs);
        }

        return View::make('pages.index');
    }


    /**
     * @param bool $timebegin
     * @param bool $timeend
     * @return mixed
     * @throws \Jyggen\Curl\Exception\CurlErrorException
     * @throws \Jyggen\Curl\Exception\ProtectedOptionException
     */
    public function getUsersActivity($timebegin = false, $timeend = false)
    {
//        http://jiratest.ofactory.biz/jira/activity?streams=update-date+BETWEEN+1416520800000+1416607199999&streams=user+IS+WildWest2&_=1416654577838
        if ($timebegin === FALSE) {
            $timebegin = 1416520800000;
        }
        IF ($timeend === FALSE) {
            $timeend = 1516520800000;
        }
        $request = new \Jyggen\Curl\Request('http://jiratest.ofactory.biz/jira/activity?streams=update-date+BETWEEN+' . $timebegin . '+' . $timeend);
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
        $simple = $response->getContent();
        $xml = simplexml_load_string($simple);
        $json = json_encode($xml);
        $usersActivityObject = json_decode($json)->entry;
        foreach ($usersActivityObject as $userActivityObject) {
            $allActivity[] = array(
                'author' => $userActivityObject->author->name
            );
            var_dump($userActivityObject);
        }
//        var_dump($allActivity);

        return View::make('pages.index');
    }
//    public function saveUsersToDatabase(){
//
//
//        return TRUE;
//    }

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

    public function getHistory()
    {
        $request = new \Jyggen\Curl\Request($this->url . 'issue/HACKWIL-8?expand=changelog');
        $request->setOption(CURLOPT_USERPWD, sprintf("%s:%s", $this->login, $this->password));
        $request->execute();
        $response = $request->getResponse();
//        var_dump($response);
        var_dump(json_decode($response->getContent())->changelog->histories[5]);

        return View::make('pages.index');
    }

}