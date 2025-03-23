<?php

require_once "models/AdminSignin.php";

class AdminSignInController
{
    public function index()
    { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin']))
        {
            $this->signin();
        }

        require "views/Public/admin/admin-signin.php";
    }

    private function signin() 
    {
        $usernameOrEmail    = htmlspecialchars(trim($_POST['username_or_email']));
        $password           = htmlspecialchars(trim($_POST['password']));

        if (AdminSignIn::signin($usernameOrEmail, $password))
        {
            header("Location: /admin-dashboard");
            exit;
        }
    }
}