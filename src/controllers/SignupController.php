<?php

require_once "models/SignUp.php";

class SignupController {
    public function index() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
            $username   = $_POST['username'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $message = SignUp::signup($username, $email, $password);
        }

        require "views/signup.php";
    }
}