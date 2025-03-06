<?php

session_start();

class SignUp {
    private static $pdo;

    public static function connect() {
        if (!self::$pdo) {
            self::$pdo = new PDO("mysql:host=localhost;dbname=course", "user", "password");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    public static function signup($username, $email, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = self::connect()->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");

        try {
            $stmt->execute([$username, $email, $password_hash]);
            return "Signup successful! You can now sign in.";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}