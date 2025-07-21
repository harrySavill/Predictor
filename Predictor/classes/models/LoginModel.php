<?php

class LoginModel
{
    private $database_handle;
    private $email;
    private $password;

    public function __construct()
    {
        $this->database_handle = null;
    }
    public function __destruct(){}
    public function setDatabaseHandle($obj_database_handle)
    {
        $this->database_handle = $obj_database_handle;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setPassword(string $password){
        $this->password = $password;
    }

    public function login(){
        $sql_query_string = SqlQuery::queryGetPassword();
        $sql_query_parameters = [':email' => $this->email];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $result = $this->database_handle->safeFetchArray();

        if ($result){
            $storedPasswordHashed = $result["password"];
            if (password_verify($this->password, $storedPasswordHashed)){
                return true;
            }
        }
            else return false;


    }
    public function getAdminStatus($email){
        $sql_query_string = SqlQuery::queryGetAdminStatus();
        $sql_query_parameters = [':email' => $email];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return $this->database_handle->fetchColumn();

    }

}