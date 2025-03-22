<?php

require_once "models/SignIn.php";

class SigninController 
{
    public function index() 
    {
        $errorMessage = $successMessage = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) 
        {
            list($successMessage, $errorMessage) = $this->signin();
        }

        require "views/Public/signin.php";
    }

    private function signin() 
    {
        if (empty($_POST['username_or_email']) || empty($_POST['password'])) 
        {
            return ["", "Барлық өрістерді толтырыңыз!"];
        }

        $usernameOrEmail = trim(htmlspecialchars($_POST['username_or_email']));
        $password = trim(htmlspecialchars($_POST['password']));

        if (!filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) && !preg_match('/^\w+$/', $usernameOrEmail)) 
        {
            return ["", "Жарамсыз пайдаланушы аты немесе электрондық пошта!"];
        }

        if (SignIn::signin($usernameOrEmail, $password)) 
        {
            header("Location: /");
            exit;
        }

        return ["", "Қате пайдаланушы аты/электрондық пошта немесе құпиясөз!"];
    }
}
