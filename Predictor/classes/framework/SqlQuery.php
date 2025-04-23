<?php
/**
 * SqlQuery.php
 */

class SqlQuery
{

    public function __construct()
    {
    }

    public function __destruct()
    {
    }


    public static function queryCreatePrediction()
    {
        $sql_query_string = 'INSERT INTO predictions (user_id, match_id)';
        $sql_query_string .= ' VALUES (:user_id, :match_id)';
        return $sql_query_string;
    }
    public static function queryGetAllUsers(){
        $sql_query_string = 'SELECT user_id FROM users';
        return $sql_query_string;
    }
    public static function queryGetAllMatchesByGameweek(){
        $sql_query_string = 'SELECT match_id,home_team, away_team FROM matches WHERE gameweek = :gameweek';
        return $sql_query_string;
    }
    public static function queryUpdateMatch(){
        $sql_query_string = 'UPDATE matches SET home_score = :home_score, away_score = :away_score WHERE match_id = :match_id';
        return $sql_query_string;
    }
    public static function queryUpdateMatchWithApi(){
        $sql_query_string = 'UPDATE matches SET home_score = :home_score, away_score = :away_score, completed =1 WHERE gameweek = :gameweek AND home_team = :home_team AND away_team = :away_team';
        return $sql_query_string;
    }
    public static function getGameweekMatchIds(){
        $sql_query_string = 'SELECT match_id FROM matches WHERE gameweek = :gameweek';
        return $sql_query_string;
    }
    public static function queryCreateMatch()
    {
        $sql_query_string = 'INSERT INTO matches (gameweek, home_team, away_team)';
        $sql_query_string .= ' VALUES (:gameweek, :home_team, :away_team)';
        return $sql_query_string;
    }

    public static function queryCreateMatchWithApi()
    {
        $sql_query_string = 'INSERT INTO matches (gameweek, home_team, away_team, home_league_position, away_league_position, match_date, league_code)';
        $sql_query_string .= ' VALUES (:gameweek, :home_team, :away_team, :home_league_position, :away_league_position, :match_date, :league_code)';
        return $sql_query_string;
    }
    public static function queryRegisterUser()
    {
        $sql_query_string  = 'INSERT INTO users (username, email, password)';
        $sql_query_string .= ' VALUES (:username, :email, :password)';
        return $sql_query_string;
    }
    public static function querySelectUsername(){
        $sql_query_string  = 'SELECT COUNT(*) FROM users WHERE username = :username';
        return $sql_query_string;
    }
    public static function querySelectEmail(){
        $sql_query_string  = 'SELECT COUNT(*) FROM users WHERE email = :email';
        return $sql_query_string;
    }
    //gets the password - unsure if a more sensible name would be queryLogin?
    public static function queryGetPassword()
    {
        $sql_query_string = 'SELECT password FROM users WHERE email = :email';
        return $sql_query_string;
    }
    public static function queryGetAdminStatus(){
        $sql_query_string  = 'SELECT account_type FROM users WHERE email = :email';
        return $sql_query_string;
    }

    public static function queryGetPredictionsByUserAndGameweek()
    {
        $sql_query_string = 'SELECT p.prediction_id, m.home_team, m.away_team, 
                                p.predicted_home_score, p.predicted_away_score 
                         FROM predictions p 
                         INNER JOIN matches m ON p.match_id = m.match_id 
                         WHERE p.user_id = :user_id AND m.gameweek = :gameweek';

        return $sql_query_string;
    }
    public static function queryUpdatePrediction()
    {
        $sql_query_string = 'UPDATE predictions SET predicted_home_score = :predicted_home_score, predicted_away_score = :predicted_away_score WHERE prediction_id = :prediction_id';
        return $sql_query_string;
    }
    public static function queryGetUserID()
    {
        $sql_query_string = 'SELECT user_id FROM users WHERE email = :email';
        return $sql_query_string;
    }
    public static function queryGetUsername()
    {
        $sql_query_string = 'SELECT username FROM users WHERE email = :email';
        return $sql_query_string;
    }
    public static function queryGeneratePredictionsForNewUser()
    {
        $sql_query_string = 'INSERT INTO predictions (user_id, match_id, predicted_home_score, predicted_away_score, points_earned) ';
        $sql_query_string .= 'SELECT :user_id, match_id, NULL, NULL, 0 FROM matches ';
        $sql_query_string .= 'WHERE NOT EXISTS (SELECT 1 FROM predictions WHERE user_id = :user_id AND match_id = matches.match_id)';
        return $sql_query_string;
    }

}

