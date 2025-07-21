<?php

class Factory
{
    public function __construct(){}

    public function __destruct(){}


    public static function buildObject($class)
    {
        $object = new $class();
        return $object;
    }

    public static function createDatabaseWrapper()
    {
        $database = Factory::buildObject('DatabaseWrapper');
        $connection_parameters = getPdoDatabaseConnectionDetails();
        $database->setConnectionSettings($connection_parameters);
        $database->connectToDatabase();
        return $database;
    }
}
