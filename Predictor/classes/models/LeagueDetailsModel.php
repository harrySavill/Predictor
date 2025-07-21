<?php

class LeagueDetailsModel
{
    private $database_handle;
    private $userID;
    private $league_id;
    private $gameweek;

    public function setDatabaseHandle($database_handle){
        $this->database_handle = $database_handle;
    }

    public function setLeagueID($league_id){
        $this->league_id = $league_id;
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

    public function getLeagueDetails(){
        $sql_query_string = SqlQuery::queryGetLeagueDetails();
        $sql_query_parameters = [':league_id' => $this->league_id];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $details = $this->database_handle->safeFetchAll()[0];

        $sql_query_string = SqlQuery::queryGetUsernameById();
        $sql_query_parameters = [':user_id' => $details['created_by']];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $details['created_by'] = $this->database_handle->fetchColumn();
        return $details;
    }

    public function createLeagueTable(){
        $sql_query_string = SqlQuery::queryGetAllUsersInLeague();
        $sql_query_parameters = [':league_id' => $this->league_id];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $users = $this->database_handle->safeFetchAll();

        foreach ($users as &$user){
            $sql_query_string = SqlQuery::queryGetUsernameById();
            $sql_query_parameters = [':user_id' => $user['user_id']];
            $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            $user['username'] = $this->database_handle->fetchColumn();

            $sql_query_string = SqlQuery::queryGetUserTotalPoints();
            $sql_query_parameters = [':user_id' => $user['user_id']];
            $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            $user['total_points'] = $this->database_handle->fetchColumn();

            $sql_query_string = SqlQuery::queryGetUserGameweekPoints();
            $sql_query_parameters = [':user_id' => $user['user_id'], 'gameweek' => $this->gameweek];
            $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            $user['gameweek_points'] = $this->database_handle->fetchColumn();
        }
        usort($users, function($a, $b) {
            return $b['total_points'] <=> $a['total_points'];
        });
        return $users;
    }
    public function getGameweek(){
        $sql_query_string = SqlQuery::queryGetGameweek();
        $sql_query_parameters = [];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return $this->database_handle->fetchColumn() -1;
    }
}