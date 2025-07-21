<?php

class PredictionsModel
{
    private $database_handle;
    private $gameweek;

    private $userID;
    private $predictionsArray;

    public function setDatabaseHandle($database_handle){
        $this->database_handle = $database_handle;
    }
    public function setGameweek($gameweek){
        $this->gameweek = $gameweek;
    }
    public function setUserID(){
        $sql_query_string = SqlQuery::queryGetUserID();
        $sql_query_parameters = [':email' => $_SESSION['email']];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userID = $this->database_handle->fetchColumn();
    }
    public function setPredictionsArray($predictionsArray){
        $this->predictionsArray = $predictionsArray;
    }

    public function getPredictions(){
        $sql_query_string = SqlQuery::queryGetPredictionsByUserAndGameweek();
        $sql_query_parameters = [':user_id' => $this->userID,':gameweek' => $this->gameweek];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return  $this->database_handle->safeFetchAll();
    }
    public function updatePredictions()
    {
        $sql_query_string = SqlQuery::queryUpdatePrediction();

        foreach ($this->predictionsArray['prediction_id'] as $prediction_id) {
            $home_key = "home_score_$prediction_id";
            $away_key = "away_score_$prediction_id";

            if (isset($this->predictionsArray[$home_key]) && isset($this->predictionsArray[$away_key])) {
                $sql_query_parameters = [
                    ':predicted_home_score' => $this->predictionsArray[$home_key],
                    ':predicted_away_score' => $this->predictionsArray[$away_key],
                    ':prediction_id' => $prediction_id,
                ];

                $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            }
        }
    }
    public function getGameweek(){
        $sql_query_string = SqlQuery::queryGetGameweek();
        $sql_query_parameters = [];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return $this->database_handle->fetchColumn();
    }
}