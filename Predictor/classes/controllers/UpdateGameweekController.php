<?php

class UpdateGameweekController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        if ($this->getRoute()=="update-gameweek"){
            if($_SESSION['admin_status'] == 'admin'){
                $this->createView();
            }
            else echo 'Unauthorized access';
        }
        elseif ($this->getRoute()== "gameweek-updated"){
            if($_SESSION['admin_status'] == 'admin'){
                $this->updateGameweek();
            }
            else echo 'Unauthorized access';

        }
        elseif ($this->getRoute() == "update-gameweek-api"){
            $this->updateGameweekApi();
        }


    }
    private function getRoute()
    {
        return $_POST['route'];
    }

    private function createView(){
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('UpdateGameweekModel');

        $model->setDatabaseHandle($database);
        $model->setGameweek($_POST['gameweek']);
        $matches = $model->getMatches();

        $view = Factory::buildObject('UpdateGameweekView');
        $view->setMatches($matches);
        $view->setAdminStatus(true);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }

    private function updateGameweek(){

        $model = Factory::buildObject('UpdateGameweekModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);
        $model->setMatchScoreArray(array_slice($_POST, 1, -1));
        $model->updateGameweek();

        $this->buildAdminToolsView();
    }

    private function updateGameweekApi(){
        $model = Factory::buildObject('UpdateGameweekModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);
        $model->setGameweek($_POST['gameweek']);

        $model->updateGameweekWithApi();

        $this->buildAdminToolsView();
    }

    private function buildAdminToolsView(){
        $view = Factory::buildObject('AdminToolsView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
            $view->createPage();
            $this->html_output = $view->getHtmlOutput();
        } else echo 'you are unauthorized to view this page';
    }

}