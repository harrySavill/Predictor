<?php
/**
 * SqlQuery.php
 */

class SqlQuery
{

    public function __construct(){}

    public function __destruct(){}

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
}

