<?php

require_once "models/Home.php";

class HomeController
{
    public function index()
    {         
        $errorMessage = $successMessage = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact'])) 
        {
            list($successMessage, $errorMessage) = $this->contact();
        }

        require "views/Public/home.php";
    }

    public function contact()
    {
        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['message'])) 
        {
            return ["", "Барлық өрістерді толтыру қажет"];
        }
        
        $firstname  = htmlspecialchars(trim($_POST['firstname']));
        $lastname   = htmlspecialchars(trim($_POST['lastname']));
        $email      = htmlspecialchars(trim($_POST['email']));
        $message    = htmlspecialchars(trim($_POST['message'])); 

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["", "Электрондық поштаның дұрыс пішімі емес"];
        }

        if (Home::contact($firstname, $lastname, $email, $message)) 
        {
            return ["Хабарлама сәтті жіберілді!", ""];
        }

        return ["", "Хабарламаны жіберу сәтсіз аяқталды. Кейінірек қайталап көріңіз."];
    }
}

