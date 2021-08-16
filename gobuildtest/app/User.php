<?php
require_once 'Connection.php';

/** Class to handle all user related processing */
class User
{
    public function __construct()
    {
        
    }

    /**
     * Method to retrieve user data from the db
     *
     * @param string $field
     * @param string $value
     * @return obj
     */
    public function getUser($field, $value)
    {
        global $database;

        $query = "SELECT * FROM users WHERE " . $field . " = '" . $value . "'";
        $getUser = $database->query($query);
        $user = $getUser->fetch_object();

        return $user;
    }

    /**
     * Method to insert ne user in database
     *
     * @param array $parameters
     * @return bool
     */
    public function createUser($parameters) {
        global $database;
        $result = false;
        $fieldString = '';
        $valueString = '';

        /** Determine last key in parameters array - used for string building */
        $lastKey = array_key_last($parameters['field']);

        /** Loop through parameters to build query strings */
        foreach ($parameters['field'] as $field => $value) {
            $fieldString .= $field;
            $valueString .= "'" . $value . "'";

            if ((string) $field !== (string) $lastKey) {
                $fieldString .= ',';
                $valueString .= ',';
            }
        }

        $query = "INSERT INTO users (" . $fieldString . ") VALUES ($valueString)";
        
        if ($database->query($query)) {
            $result = true;
        }

        return $result;
    }

    /**
     * Method to update user data
     *
     * @param array $parameters
     * @return bool
     */
    public function updateUser($parameters)
    {
        global $database;
        $result = false;
        $updateString = '';
        $where = '';
        $email = '';

        if (array_key_exists('email', $parameters)) {
            $email = $parameters['email'];
        }
        
        /** Determine which lookup criteria to use in query */
        if (isset($_SESSION['userId'])) {
            $where = "user_id = " . $_SESSION['userId'];
        } else {
            $where = "email = '" . $email . "'";
        }
        
        /** Determine last key for query string */
        $lastKey = array_key_last($parameters['field']);

        /** Build query string */
        foreach ($parameters['field'] as $field => $value) {
            $updateString = $field . "='" . $value . "'";

            if ((string) $field !== (string) $lastKey) {
                $updateString .= ',';
            }
        }

        $updateQuery = "UPDATE users SET " . $updateString . " WHERE " . $where;
        
        if ($database->query($updateQuery)) {
            $result = true;
        }

        return $result;
    }
}