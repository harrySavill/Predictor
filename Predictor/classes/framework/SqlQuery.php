<?php

class SqlQuery
{

    public function __construct()
    {
    }

    public function __destruct()
    {
    }


    public static function queryGetUserLeagues()
    {
        $sql_query_string = 'SELECT l.league_id, l.name FROM leagues l INNER JOIN user_leagues ul ON l.league_id = ul.league_id WHERE ul.user_id = :user_id;';
        return $sql_query_string;
    }
    public static function queryGetLeagueUserCount()
        {
        $sql_query_string = 'SELECT COUNT(*) FROM user_leagues WHERE league_id = :league_id;';
        return $sql_query_string;
    }
    public static function queryGetLeagueScores()
    {
        $sql_query_string = 'SELECT 
                ul.user_id,
                SUM(p.points_earned) AS total_points
            FROM user_leagues ul
            LEFT JOIN predictions p ON ul.user_id = p.user_id
            WHERE ul.league_id = :league_id
            GROUP BY ul.league_id, ul.user_id;';
        return $sql_query_string;
    }
    public static function queryGetLeagueDetails()
    {
        $sql_query_string = 'SELECT name, join_code, created_by FROM leagues WHERE league_id = :league_id;';
        return $sql_query_string;
    }
    public static function queryCheckJoinCodeExists()
    {
        $sql_query_string = 'SELECT COUNT(*) FROM leagues WHERE join_code = :join_code';
        return $sql_query_string;
    }
    public static function queryCreateLeague()
    {
        $sql_query_string = 'INSERT INTO leagues (name, join_code, created_by)';
        $sql_query_string .= ' VALUES (:name, :join_code, :created_by)';
        return $sql_query_string;
    }

    public static function queryGetLeagueID()
    {
        $sql_query_string = 'SELECT league_id FROM leagues WHERE join_code = :join_code';
        return $sql_query_string;
    }
    public static function queryJoinLeague()
    {
        $sql_query_string = 'INSERT INTO user_leagues (user_id, league_id)';
        $sql_query_string .= ' VALUES (:user_id, :league_id)';
        return $sql_query_string;
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
        $sql_query_string = 'SELECT p.prediction_id, m.home_team, m.away_team,  m.home_league_position, m.away_league_position, 
                                p.predicted_home_score, p.predicted_away_score 
                         FROM predictions p 
                         INNER JOIN matches m ON p.match_id = m.match_id 
                         WHERE p.user_id = :user_id AND m.gameweek = :gameweek';

        return $sql_query_string;
    }

    public static function queryGetPredictedandActualScores()
{
    $sql_query_string = 'SELECT p.prediction_id, p.predicted_home_score, p.predicted_away_score,
                        m.home_score AS actual_home_score, m.away_score AS actual_away_score
                        FROM predictions p
                        JOIN matches m ON p.match_id = m.match_id
                        WHERE m.gameweek = :gameweek AND m.league_code = :league_code';

    return $sql_query_string;
}
    public static function queryUpdatePredictionPoints()
    {
        $sql_query_string = "UPDATE predictions SET points_earned = :points_earned WHERE prediction_id = :prediction_id";
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
    public static function queryGetUsernameById()
    {
        $sql_query_string = 'SELECT username FROM users WHERE user_id = :user_id;';
        return $sql_query_string;
    }
    public static function queryGetAllUsersInLeague()
    {
        $sql_query_string = 'SELECT user_id FROM user_leagues WHERE league_id = :league_id';
        return $sql_query_string;
    }
    public static function queryGeneratePredictionsForNewUser()
    {
        $sql_query_string = 'INSERT INTO predictions (user_id, match_id, predicted_home_score, predicted_away_score, points_earned) ';
        $sql_query_string .= 'SELECT :user_id, match_id, NULL, NULL, 0 FROM matches ';
        $sql_query_string .= 'WHERE NOT EXISTS (SELECT 1 FROM predictions WHERE user_id = :user_id AND match_id = matches.match_id)';
        return $sql_query_string;
    }
    public static function queryGetResults()
    {
        $sql_query_string = 'SELECT m.match_id, m.home_team, m.away_team, m.home_score, m.away_score, p.predicted_home_score, p.predicted_away_score, p.points_earned
            FROM 
                predictions p
                INNER JOIN matches m ON p.match_id = m.match_id
            WHERE 
                p.user_id = :user_id AND m.gameweek = :gameweek
            ORDER BY 
                m.match_date';
                    return $sql_query_string;
}
public static function queryCheckIfUserIsInLeague()
{
        $sql_query_string = 'SELECT COUNT(*)
                FROM user_leagues ul INNER JOIN leagues l ON ul.league_id = l.league_id 
                WHERE l.join_code = :join_code AND ul.user_id = :user_id;';
        return $sql_query_string;
}

public static function queryleaveLeague(){
        $sql_query_string = 'DELETE FROM user_leagues WHERE user_id = :user_id AND league_id = :league_id';
        return $sql_query_string;
}
public static function queryGetUserTotalPoints()
{
    $sql_query_string = 'SELECT SUM(points_earned) AS total_points
                        FROM predictions
                        WHERE user_id = :user_id;' ;
    return $sql_query_string;
}
public static function queryGetUserGameweekPoints()
{
    $sql_query_string = 'SELECT SUM(p.points_earned) AS gameweek_score FROM predictions p 
    JOIN matches m ON p.match_id = m.match_id 
    WHERE p.user_id = :user_id AND m.gameweek = :gameweek;';
    return $sql_query_string;
}
public static function queryGetGameweek()
{
    $sql_query_string = 'SELECT gameweek FROM matches WHERE match_date > NOW() ORDER BY match_date ASC LIMIT 1;';
    return $sql_query_string;
}
}

