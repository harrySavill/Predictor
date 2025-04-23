<?php

class LeaguesModel
{
    private $database_handle;

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }
    public function getUsername(){
        $sql_query_string = SqlQuery::queryGetUsername();
        $sql_query_parameters = [':email' => $_SESSION['email']];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        return $this->database_handle->fetchColumn();
    }
}