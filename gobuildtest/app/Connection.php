<?php
require_once 'includes/db_config.php';

/**
 * Database connection class
 * 
 * creating test line for git
 */
class Connection
{
    /**
     * @var mysqli|Exception
     */
    public $connection;

    /**
     * Constructor
     * Creates database connection
     */
    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        } catch (Exception $exception) {
            /** Throw exception if connection failed */
            error_log("Database connection failed. " . $this->connection->connect_error);

            exit;
        }
    }

    /**
     * Complete DBO call
     *
     * @param string $query
     * @return mysqli|Exception
     */
    public function query($query)
    {
        try {
            $query = $this->connection->query($query);
        } catch (Exception $exception) {
            /** Throw exception if query failed */
            error_log("Sql query failed. " . $this->connection->connect_error);

            exit;
        }

        return $query;
    }
}

$database = new Connection();