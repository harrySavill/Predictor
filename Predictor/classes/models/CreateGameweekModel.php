<?php

class CreateGameweekModel
{
    private $database_handle;
    private $gameweek;
    private $gameweekArray;
    private $matchIds;
    private $users;
    public function setDatabaseHandle($database_handle){
        $this->database_handle = $database_handle;
    }
    public function setGameweek($gameweek){
        $this->gameweek = $gameweek;
    }
    public function setGameweekArray($gameweekArray){
        $this->gameweekArray = $gameweekArray;
    }
    public function setMatchIds(){
        $sql_query_string = SqlQuery::getGameweekMatchIds();
        $sql_query_parameters = [':gameweek' => $this->gameweek];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->matchIds = $this->database_handle->safeFetchAll();

    }
    public function setUsers(){
        $sql_query_string = SqlQuery::queryGetAllUsers();
        $this->database_handle->safeQuery($sql_query_string);
        $this->users = $this->database_handle->safeFetchAll();
    }
    public function createGameweek(){
        $matches = [];
        $matchIndex = 0;
        while (isset($this->gameweekArray["home-team-$matchIndex"])&&isset($this->gameweekArray["away-team-$matchIndex"])){
            $homeTeam = $this->gameweekArray["home-team-$matchIndex"];
            $awayTeam = $this->gameweekArray["away-team-$matchIndex"];


            $matches[] = [
                "homeTeam" => $homeTeam,
                "awayTeam" => $awayTeam
            ];
            $matchIndex++;
        }

        $sql_query_string = SqlQuery::queryCreateMatch();
        foreach ($matches as $index => $match) {
            $sql_query_parameters = [':gameweek' => $this->gameweek, ':home_team' => $match['homeTeam'], ':away_team' => $match['awayTeam']];
            $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        }

        $this->generatePredictions();

    }
    public function createGameweekWithAPI(){

            $league = $_POST['league'];
            $client = Factory::buildObject('FootballApiClient');
            $client->setLeagueCode($league);
            $gameweek = $_POST['gameweek'];
            $fixtures = $client->getFixturesWithDetails($gameweek);

            if (empty($fixtures)) {
                die("no fixtures found");
            } else {
                $sql_query_string = SqlQuery::queryCreateMatchWithApi();
                foreach ($fixtures as $fixture) {
                    $sql_query_parameters = [':gameweek' => $_POST['gameweek'], ':home_team' => $fixture['home_team']['name'], ':away_team' => $fixture['away_team']['name'], ':home_league_position' => $fixture['home_team']['position'], ':away_league_position' => $fixture['away_team']['position'], ':match_date' => $fixture['date'], ':league_code' => $league];
                    $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
                }
                $this->setGameweek($gameweek);
                $this->generatePredictions();
            }
    }

    private  function generatePredictions(){
        $this->setMatchIds();
        $this->setUsers();

        $sql_query_string = SqlQuery::queryCreatePrediction();
        foreach ($this->matchIds as $matchId) {
            foreach ($this->users as $user) {
                $sql_query_parameters = [':match_id' => $matchId['match_id'], ':user_id' => $user['user_id']];
                $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
            }
        }
    }
}