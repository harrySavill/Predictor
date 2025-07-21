<?php

class AdminToolsController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $view = Factory::buildObject('AdminToolsView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
        } else die('you are unauthorized to view this page');
    }
}