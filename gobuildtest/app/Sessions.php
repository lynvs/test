<?php

/** Class to comlpete session work */
class Sessions
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Method to set relevant session variables
     *
     * @param obj $userObject
     */
    public function setSession($userObject)
    {
        $_SESSION['userId'] = $userObject->user_id;
    }

    /**
     * Method to destroy the session on logout
     */
    public function destroySession()
    {
        session_destroy();
    }
}