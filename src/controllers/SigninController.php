<?php

require_once "models/SignIn.php";

class SigninController {
    public function index() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $message = SignIn::signin($username, $password);
        }

        require "views/signin.php";
    }
}