<?php

class CreateGameweekController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $route = $this->getRoute();

        if ($route == "create-gameweek") {
            if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 'admin') {
                $view = Factory::buildObject('CreateGameweekView');
                $view->setAdminStatus(true);
                $view->createPage();
                $this->html_output = $view->getHtmlOutput();
            } else {
                $this->html_output = 'Unauthorized access';
            }
        } elseif ($route == "gameweek-created") {
            $this->createGameweek();
        } elseif ($route == "create-gameweek-api") {
            $this->createGameweekApi();
        }
    }

    private function getRoute()
    {
        return $_POST['route'] ?? 'none';
    }
    private function createGameweekApi()
    {
        $model = Factory::buildObject('CreateGameweekModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);
        $model->createGameweekWithAPI();

        $this->buildAdminToolsView();
    }

    private function createGameweek()
    {
        $model = Factory::buildObject('CreateGameweekModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);
        $model->setGameweek($_POST['gameweek']);
        $model->setGameweekArray(array_slice($_POST, 1, -1));
        $model->createGameweek();

        $this->buildAdminToolsView();
    }
    private function buildAdminToolsView(){
        $view = Factory::buildObject('AdminToolsView');
        if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 'admin') {
            $view->setAdminStatus(true);
            $view->createPage();
            $this->html_output = $view->getHtmlOutput();
        } else {
            $this->html_output = 'You are unauthorized to view this page';
        }
    }
}

