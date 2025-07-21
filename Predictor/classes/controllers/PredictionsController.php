<?php

class PredictionsController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        if($this->getRoute()=='predictions'|| $this->getRoute()=='login-submit'){
            $this->createPredictionsView();
        }elseif ($this->getRoute()=='predictions-made'){
           $this->updatePredictions();
            }
        }

    private function getRoute()
    {
        return $_POST['route'];
    }
    private function createPredictionsView($error_message = ''){
        $view = Factory::buildObject('PredictionsView');
        if($_SESSION['admin_status'] == 'admin'){
            $view->setAdminStatus(true);
        }
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('PredictionsModel');


        $model->setDatabaseHandle($database);
        $gameweek = $model->getGameweek();
        $model->setUserID();
        $model->setGameweek(37); //hardcoded for presentation as all football fixtures are finished - usually uses $gameweek
        $predictions = $model->getPredictions();

        $view->setPredictions($predictions);
        if(!empty($error_message)){
            $view->setErrorMessage($error_message);
        }
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
    private function updatePredictions(){
        $model = Factory::buildObject('PredictionsModel');
        $database = Factory::createDatabaseWrapper();
        $validator = Factory::buildObject('Validate');

        $predictions = array_slice($_POST, 1, -1);

        $valid = true;
        foreach ($predictions as $prediction) {
            if (is_array($prediction)) {
                continue; //allows the predictions_id array to be validated

            }
            if ($validator->validateInt($prediction) === false) {
                $valid = false;
                break;
            }
        }

        if ($valid) {
            $model->setDatabaseHandle($database);
            $model->setPredictionsArray($predictions);
            $model->updatePredictions();
            $this->createPredictionsView();
        } else $this->createPredictionsView("predictions invalid, make sure to use integers");

    }
}
