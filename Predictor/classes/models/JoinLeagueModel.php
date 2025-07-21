<?php

class JoinLeagueModel
{
    private $database_handle;
    private $userID;
    private $join_code;

    public function setDatabaseHandle($database_handle){
        $this->database_handle = $database_handle;
    }

    public function setJoinCode($join_code){
        $this->join_code = $join_code;
    }

    public function setUserID($email){
        $sql_query_string = SqlQuery::queryGetUserID();
        $sql_query_parameters = [':email' => $email];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userID = $this->database_handle->fetchColumn();
    }

    public function joinLeague(){
        $sql_query_string  = SqlQuery::queryCheckIfUserIsInLeague();
        $sql_query_parameters = [':join_code' => $this->join_code, ':user_id' => $this->userID];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $count = $this->database_handle->fetchColumn();

        if($count){
            return false;
        }

        $sql_query_string = SqlQuery::queryGetLeagueID();
        $sql_query_parameters = [':join_code' => $this->join_code];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $leagueID = $this->database_handle->fetchColumn();

        if (empty($leagueID)){
            return false;
        }

        $sql_query_string = SqlQuery::queryJoinLeague();
        $sql_query_parameters = [':user_id' => $this->userID, ':league_id' => $leagueID];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return true;
    }
}