<?php

class LeagueDetailsController extends ControllerAbstract
{
    public function createHtmlOutput()
    {


        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('LeagueDetailsModel');
        $model->setDatabaseHandle($database);
        $model->setLeagueID($_POST["league_id"]);
        $model->setUserID($_SESSION["email"]);
        $gameweek = $model->getGameweek();
        $model->setGameweek(37); //hardcoded for presentation as all football fixtures are finished - usually uses $gameweek

        $leagueDetails = $model->getLeagueDetails();
        $leagueTable = $model->createLeagueTable();
        $view = Factory::buildObject('LeagueDetailsView');
        $view->setLeagueDetails($leagueDetails);
        $view->setUsers($leagueTable);
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        }
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
}