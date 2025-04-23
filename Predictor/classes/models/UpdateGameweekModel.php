<?php

class UpdateGameweekModel
{
    private $database_handle;
    private $gameweek;

    private $matchScoreArray;

    public function setDatabaseHandle($database_handle){
        $this->database_handle = $database_handle;
    }
    public function setGameweek($gameweek){
        $this->gameweek = $gameweek;
    }
    public function setMatchScoreArray($matchScoreArray){
        $this->matchScoreArray = $matchScoreArray;
    }

    public function getMatches(){
        $sql_query_string = SqlQuery::queryGetAllMatchesByGameweek();
        $sql_query_parameters = [':gameweek' => $this->gameweek];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return  $this->database_handle->safeFetchAll();
    }

    public function updateGameweek()
    {
        $sql_query_string = SqlQuery::queryUpdateMatch();
        foreach ($this->matchScoreArray['match_id'] as $match_id) {
            $home_key = "home_score_$match_id";
            $away_key = "away_score_$match_id";

            if (isset($this->matchScoreArray[$home_key]) && isset($this->matchScoreArray[$away_key])) {
                $sql_query_parameters = [
                    ':home_score' => $this->matchScoreArray[$home_key],
                    ':away_score' => $this->matchScoreArray[$away_key],
                    ':match_id' => $match_id,
                ];

                $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            }
        }
    }
    public function updateGameweekWithApi()
    {
        $league_code = $_POST['league'];
        $client = new FootballApiClient($league_code);
        $client->setLeagueCode($league_code);
        $finalScores = $client->getFinalScores($this->gameweek);

        if (empty($finalScores)) {
            die("no final scores found for this gameweek and league, please try again later");
        } else {
            $sql_query_string = SqlQuery::queryUpdateMatchWithApi();
            foreach ($finalScores as $match) {
                $sql_query_parameters = [':home_score' => $match['home_team']['score'], ':away_score' => $match['away_team']['score'], ':gameweek' => $this->gameweek, ':home_team' => $match['home_team']['name'], ':away_team' => $match['away_team']['name']];
                $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            }
        }
    }

    private function updateUserScores()
    {

    }

}