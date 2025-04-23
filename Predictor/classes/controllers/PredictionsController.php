<?php

class PredictionsController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        if($this->getRoute()=='predictions'){
            $this->createPredictionsView();
        }elseif ($this->getRoute()=='predictions-made'){
           $this->updatePredictions();
            }
        }

    private function getRoute()
    {
        return $_POST['route'];
    }
    private function createPredictionsView(){
        $view = Factory::buildObject('PredictionsView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        }
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('PredictionsModel');

        $model->setDatabaseHandle($database);
        $model->setUserID();
        $model->setGameweek(36);
        $predictions = $model->getPredictions();

        $view->setPredictions($predictions);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
    private function updatePredictions(){
        $model = Factory::buildObject('PredictionsModel');
        $database = Factory::createDatabaseWrapper();
        $model->setDatabaseHandle($database);
        $model->setPredictionsArray(array_slice($_POST, 1, -1));
        $model->updatePredictions();

        $this->createPredictionsView();

    }
}