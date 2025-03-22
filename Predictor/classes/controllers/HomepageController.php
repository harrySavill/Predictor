<?php

class HomepageController extends ControllerAbstract
{

    protected function createHtmlOutput()
    {
        $view = Factory::buildObject('HomepageView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
}