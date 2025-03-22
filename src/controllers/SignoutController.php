<?php 

class SignoutController 
{
    public function index() 
    {

        session_start();
        // Destroy the session and unset all session variables
        $_SESSION = [];
        session_destroy();

        // Redirect to the login page or homepage
        header("Location: /signin");
        exit;
    }
}