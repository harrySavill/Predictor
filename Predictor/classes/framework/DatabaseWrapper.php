<?php

class DatabaseWrapper
{
    private $database_connect_details;
    private $database_connection_messages;
    private $database_handle;
    private $prepared_statement;

    public function __construct()
    {
        $this->database_connect_details = array();
        $this->database_handle = null;
        $this->prepared_statement = null;
        $this->database_connection_messages = array();
    }


    public function __destruct()
    {
        $this->database_handle = null;
    }


    public function setConnectionSettings($connection_settings)
    {
        $this->database_connect_details = $connection_settings;
    }


    public function connectToDatabase()
    {
        $database_connection_error = false;
        $pdo_dsn = $this->database_connect_details['pdo_dsn'];
        $pdo_user_name = $this->database_connect_details['pdo_user_name'];
        $pdo_user_password = $this->database_connect_details['pdo_user_password'];

        try {
            $this->database_handle = new PDO($pdo_dsn, $pdo_user_name, $pdo_user_password);
            $this->database_connection_messages['connection'] = 'Connected to the database.';
        } catch (PDOException $exception_object) {
            $this->database_connection_messages['connection'] = 'Cannot connect to the database.';
            $database_connection_error = true;
            trigger_error($exception_object);
        }
        $this->database_connection_messages['database-connection-error'] = $database_connection_error;
    }

    public function getConnectionMessages()
    {
        return $this->database_connection_messages;
    }

    public function safeQuery($query_string, $query_parameters = null)
    {
        $database_query_execute_error = false;

        try {
            $temp = array();
            $this->database_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->prepared_statement = $this->database_handle->prepare($query_string);

            $execute_result = $this->prepared_statement->execute($query_parameters);
            $this->database_connection_messages['execute-OK'] = $execute_result;
        } catch (PDOException $exception_object) {
            $error_message  = 'PDO Exception caught. ';
            $error_message .= 'Error with the database access. ';
            $error_message .= 'SQL query: ' . $query_string;
            $error_message .= 'Error: ' . print_r($this->prepared_statement->errorInfo(), true) . "\n";

            $database_query_execute_error = true;
            $this->database_connection_messages['sql-error'] = $error_message;
            $this->database_connection_messages['pdo-error-code'] = $this->prepared_statement->errorInfo();
            trigger_error($exception_object);
        }
        $this->database_connection_messages['database-query-execute-error'] = $database_query_execute_error;
        return $this->database_connection_messages;
    }

    public function fetchColumn()
    {
        return $this->prepared_statement->fetchColumn();
    }



    public function countRows()
    {
        $num_rows = $this->prepared_statement->rowCount();
        return $num_rows;
    }


    public function countFields()
    {
        $num_fields = $this->prepared_statement->columnCount();
        return $num_fields;
    }


    public function safeFetchArray()
    {
        $row = $this->prepared_statement->fetch(PDO::FETCH_ASSOC);
        if (is_array($row)) {
            $row = $this->escapeOutput($row);
        }
        return $row;
    }


    public function safeFetchAll()
    {
        $rows = $this->prepared_statement->fetchAll(PDO::FETCH_ASSOC);
        if (is_array($rows)) {
            foreach ($rows as &$row) {
                $row = $this->escapeOutput($row);
            }
        }
        return $rows;
    }


    public function lastInsertedId()
    {
        $sql_query = 'SELECT LAST_INSERT_ID()';

        $this->safeQuery($sql_query);
        $last_inserted_id = $this->safeFetchArray();
        $last_inserted_id = $last_inserted_id['LAST_INSERT_ID()'];
        return $last_inserted_id;
    }


    private function escapeOutput(array $row): array
    {
        $output_row = [];
        foreach ($row as $key => $item) {
            if ($item !== null) {
                $output_row[$key] = htmlspecialchars($item);
            }
        }
        return $output_row;
    }
}
