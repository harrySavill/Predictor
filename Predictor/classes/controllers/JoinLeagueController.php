<?php

class JoinLeagueController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $view = Factory::buildObject('JoinLeagueView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        }
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
}