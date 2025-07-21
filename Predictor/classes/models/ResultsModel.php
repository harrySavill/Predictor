<?php

class ResultsModel
{
    private $database_handle;
    private $gameweek;

    private $userID;


    public function setDatabaseHandle($database_handle){
        $this->database_handle = $database_handle;
    }
    public function setGameweek($gameweek){
        $this->gameweek = $gameweek;
    }
    public function setUserID($email){
        $sql_query_string = SqlQuery::queryGetUserID();
        $sql_query_parameters = [':email' => $email];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userID = $this->database_handle->fetchColumn();
    }
    public function getResults(){
        $sql_query_string = SqlQuery::queryGetResults();
        $sql_query_parameters = [':user_id' => $this->userID, ':gameweek' => $this->gameweek];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $results = $this->database_handle->safeFetchAll();

        foreach ($results as &$result) {
            if ($result['points_earned'] == 10) {
                $result['color_class'] = 'green';
            } elseif ($result['points_earned'] > 0) {
                $result['color_class'] = 'orange';
            } else {
                $result['color_class'] = 'red';
            }
        }

        return $results;

    }
    public function getGameweek(){
        $sql_query_string = SqlQuery::queryGetGameweek();
        $sql_query_parameters = [];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return $this->database_handle->fetchColumn() -1;
    }
}