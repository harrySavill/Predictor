<?php

class ResultsController extends ControllerAbstract
{
    public function createHtmlOutput()
{
    $view = Factory::buildObject('ResultsView');
    if($_SESSION['admin_status'] == 'admin'){
        $view->setAdminStatus(true);
    }
    $view->setResults($this->getResults());
    $view->createPage();
    $this->html_output = $view->getHtmlOutput();
    }

    private function getResults(){
        $model = Factory::buildObject('ResultsModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);
        $model->setUserId($_SESSION['email']);

        $gameweek = $model->getGameweek();
        $model->setGameweek(37); //hardcoded for presentation as all football fixtures are finished - usually uses $gameweek

        return $model->getResults();
    }
}