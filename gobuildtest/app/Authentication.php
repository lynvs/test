<?php
require_once 'Connection.php';

/**
 * Class to handle authentication queries and requests
 */
class Authentication
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        
    }

    /**
     * Method for validating user loging credentials
     *
     * @param string $email
     * @param string $password
     * @return int
     */
    public function validateUser($email, $password)
    {
        global $database;
        $result = 0;

        /** Fetch password and user_id from db */
        $query = "SELECT user_id, password FROM users WHERE email = '" . $email . "'";
        $getUser = $database->query($query);
        $user = $getUser->fetch_object();

        /** Verify that password matches submitted details */
        if (
            password_verify($password, $user->password) === true &&
            $user->user_id !== null && (string) $user->user_id !== ''
        ) {
            $result = $user->user_id;
        }

        return $result;
    }

    /**
     * Validate that user email exists in the database
     * 
     * Notes:
     * Note, in the database the email field is unique
     * There cannot be duplicate email addresses that will confuse these results returning incorrect user details
     * @param string $email
     * @return bool
     */
    public function validateEmail($email)
    {
        global $database;
        $result = false;

        $query = "SELECT email FROM users WHERE email = '" . $email . "'";
        $getEmail = $database->query($query);
        $getEmail->fetch_object();

        if ((int) $getEmail->num_rows > 0) {
            $result = true;
        }

        return $result;
    }
}

$authentication = new Authentication;