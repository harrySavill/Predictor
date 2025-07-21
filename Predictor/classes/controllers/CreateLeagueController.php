<?php

class CreateLeagueController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $view = Factory::buildObject('CreateLeagueView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        }
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }


}