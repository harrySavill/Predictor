<?php

class LeaguesController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $view = Factory::buildObject('LeaguesView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        }

        $model = Factory::buildObject('LeaguesModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);

        $username = $model-> getUsername();

        $view->setUsername($username);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
}