<?php

class LeaguesController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        if ($this->getRoute() == 'leagues'){
            $this->buildLeaguesPage();
        }
        elseif ($this->getRoute() == 'create-league-submit'){
            $this->createLeague();
        }
        elseif ($this->getRoute() == 'join-league-submit'){
            $this->joinLeague();
        }
        elseif ($this->getRoute() == 'leave-league'){
            $this->leaveLeague();
        }
    }

    private function getRoute()
    {
        return $_POST['route'];
    }

    private function buildLeaguesPage()
    {
        $view = Factory::buildObject('LeaguesView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        }

        $model = Factory::buildObject('LeaguesModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);
        $model->setUserID($_SESSION['email']);

        $username = $model-> getUsername($_SESSION['email']);
        $leagues = $model-> getLeagues();

        $view->setUsername($username);
        $view->setLeagues($leagues);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }

    private function createLeague(){
        $model = Factory::buildObject("CreateLeagueModel");
        $database = Factory::createDatabaseWrapper();
        $validator = Factory::buildObject('Validate');

        if($validator->validateString($_POST['league_name'], 1,25)){
            $model->setDatabaseHandle($database);
            $model->setLeagueName($_POST['league_name']);
            $model->setUserID($_SESSION['email']);

            $model->createLeague();

            $this->buildLeaguesPage();
        }
        else {
            $view = Factory::buildObject('CreateLeagueView');
            if($_SESSION['admin_status'] == 'admin'){
                $view->setAdminStatus(true);
            }
            $view->setErrorMessage("Invalid league name - league names cannot be more than 25 characters");
            $view->createPage();
            $this->html_output = $view->getHtmlOutput();
        }


    }
    private function joinLeague(){
        $model = Factory::buildObject("JoinLeagueModel");
        $database = Factory::createDatabaseWrapper();

        $model->setDatabaseHandle($database);
        $model->setJoinCode($_POST['join_code']);
        $model->setUserID($_SESSION['email']);

        if($model->joinLeague()){
            $this->buildLeaguesPage();
        }
        else {
            $view = Factory::buildObject('JoinLeagueView');
            $view->setErrorMessage("Error, please try again");
            $view->createPage();
            $this->html_output = $view->getHtmlOutput();
        }

    }
    private function leaveLeague()
    {
        $model = Factory::buildObject("LeaguesModel");
        $database = Factory::createDatabaseWrapper();

        $model->setDatabaseHandle($database);
        $model->setJoinCode($_POST['join_code']);
        $model->setUserID($_SESSION['email']);


        $model->leaveLeague();

        $this->buildLeaguesPage();
    }
}