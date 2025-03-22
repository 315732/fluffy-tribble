<?php

require_once "models/SignUp.php";

class SignupController
{
    public function index()
    {
        $successMessage = $errorMessage = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) 
        {
            list($successMessage, $errorMessage) = $this->signup();
        }

        require "views/Public/signup.php";
    }

    private function signup()
    {
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_match'])) 
        {
            return ["", "Барлық өрістерді толтырыңыз!"];
        }

        $username      = trim(htmlspecialchars($_POST['username']));
        $email         = trim(htmlspecialchars($_POST['email']));
        $password      = trim(htmlspecialchars($_POST['password']));
        $passwordMatch = trim(htmlspecialchars($_POST['password_match']));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            return ["", "Электрондық пошта дұрыс емес!"];
        }

        if ($password !== $passwordMatch) 
        {
            return ["", "Құпиясөздер сәйкес келмейді!"];
        }

        if (strlen($password) < 8) 
        {
            return ["", "Құпиясөз кемінде 8 таңбадан тұруы керек!"];
        }

        // Attempt to register the user
        $result = SignUp::signup($username, $email, $password);

        if ($result === true) 
        {
            header("Location: /signin");
            exit;
        }

        return ["", $result]; // Assuming SignUp::signup() returns an error message
    }
}
