<?php

class LeaguesModel
{
    private $database_handle;
    private $userID;
    private $join_code;

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }
    public function getUsername($email){
        $sql_query_string = SqlQuery::queryGetUsername();
        $sql_query_parameters = [':email' => $email];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return $this->database_handle->fetchColumn();
    }
    public function setJoinCode($join_code){
        $this->join_code = $join_code;
    }

    public function setUserID($email)
    {
        $sql_query_string = SqlQuery::queryGetUserID();
        $sql_query_parameters = [':email' => $email];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userID = $this->database_handle->fetchColumn();
    }
    public function getLeagues()
    {
        $sql_query_string = SqlQuery::queryGetUserLeagues();
        $sql_query_parameters = [':user_id' => $this->userID];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $leagues =  $this->database_handle->safeFetchAll();

        foreach ($leagues as &$league) {
            $sql_query_string = SQLQuery::queryGetLeagueUserCount();
            $sql_query_parameters = [':league_id' => $league['league_id']];
            $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            $league['count'] = $this->database_handle->fetchColumn();

            $sql_query_string = SqlQuery::queryGetLeagueScores();
            $sql_query_parameters = [':league_id' => $league['league_id']];
            $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            $scores = $this->database_handle->safeFetchAll();

            usort($scores, function($a, $b) {
                return $b['total_points'] <=> $a['total_points'];
            });
            $rank = 1;
            foreach ($scores as $score) {
                if ($score['user_id'] == $this->userID) {
                    $league['rank'] = $rank;
                    break;
                } else $rank++;
            }


        }
        unset($league);
        return $leagues;
    }
    public function leaveLeague(){
        $sql_query_string = SqlQuery::queryGetLeagueId();
        $sql_query_parameters = [':join_code' => $this->join_code];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $league_id = $this->database_handle->fetchColumn();

        $sql_query_string = SqlQuery::queryleaveLeague();
        $sql_query_parameters = [':user_id' => $this->userID,':league_id' => $league_id];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

    }
}
