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

    public function updateUserScores()
    {
        $sql_query_string = SqlQuery::queryGetPredictedandActualScores();
        $sql_query_parameters = [':gameweek' => $this->gameweek, ':league_code' => $_POST['league']];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $scores = $this->database_handle->safeFetchAll();

        // Echo each result
        foreach ($scores as $score) {
        $predicted_home_score = $score['predicted_home_score'] ?? null;
        $predicted_away_score = $score['predicted_away_score'] ?? null;
        $actual_home_score = $score['actual_home_score'] ?? null;
        $actual_away_score = $score['actual_away_score'] ?? null;

        if ($actual_away_score === null || $actual_home_score === null) {
            die("gameweek not yet complete, please try again later");
            }

        else{
                $points = $this->calculatePoints($predicted_home_score, $predicted_away_score, $actual_home_score, $actual_away_score);
                $sql_query_string = SqlQuery::queryUpdatePredictionPoints();
                $sql_query_parameters = [':points_earned' => $points, ':prediction_id' => $score['prediction_id']];
                $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            }
        }
    }


    private function calculatePoints($predicted_home, $predicted_away, $actual_home, $actual_away)
    {
        // Return 0 if no prediction was made
        if (is_null($predicted_home) || is_null($predicted_away)) {
            return 0;
        }

        // Check for exact score prediction
        if ($predicted_home == $actual_home && $predicted_away == $actual_away) {
            return 10;
        }

        // Check for correct goal difference
        if (($predicted_home - $predicted_away) == ($actual_home - $actual_away)) {
            return 6;
        }

        // Determine predicted and actual match outcomes (H = Home win, A = Away win, D = Draw)
        $predicted_result = $predicted_home > $predicted_away ? 'H' : ($predicted_home < $predicted_away ? 'A' : 'D');
        $actual_result = $actual_home > $actual_away ? 'H' : ($actual_home < $actual_away ? 'A' : 'D');

        // Check for correct match outcome
        if ($predicted_result === $actual_result) {
            return 3;
        }


        return 0;
    }



}