<?php

class CreateLeagueModel
{
    private $database_handle;
    private $league_name;
    private $userID;
    private $join_code;

    public function setDatabaseHandle($database_handle){
        $this->database_handle = $database_handle;
    }

    public function setLeagueName($league_name){
        $this->league_name = $league_name;
    }

    public function setUserID($email){
        $sql_query_string = SqlQuery::queryGetUserID();
        $sql_query_parameters = [':email' => $email];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userID = $this->database_handle->fetchColumn();
    }
    private function createUniqueCode()
    {
        $max_attempts = 3;
        $attempt = 0;

        do {
            if ($attempt >= $max_attempts) {
                die("Failed to generate a unique code after $max_attempts attempts.");
            }

            $this->join_code = bin2hex(random_bytes(4));  // creates a random 8 char hex string - 4 random binary bytes converted to hex
            $sql_query_string = SqlQuery::queryCheckJoinCodeExists();
            $sql_query_parameters = [':join_code' => $this->join_code];
            $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            $count = $this->database_handle->fetchColumn();
            $attempt++;
        } while ($count > 0);
    }

    public function createLeague(){
        $this->createUniqueCode();

        $sql_query_string = SqlQuery::queryCreateLeague();
        $sql_query_parameters = [':name' => $this->league_name, ':join_code' => $this->join_code, ':created_by' => $this->userID];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

        $this->addCreatorToLeague();
    }
    private function addCreatorToLeague(){
        $sql_query_string = SqlQuery::queryGetLeagueID();
        $sql_query_parameters = [':join_code' => $this->join_code];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $leagueID = $this->database_handle->fetchColumn();

        $sql_query_string = SqlQuery::queryJoinLeague();
        $sql_query_parameters = [':user_id' => $this->userID, ':league_id' => $leagueID];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
    }

}