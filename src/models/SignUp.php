<?php

require_once "core/Database.php";

class SignUp 
{
    public static function signup(string $username, string $email, string $password): bool|string 
    {
        $pdo = Database::connect();

        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->fetchColumn() > 0) 
        {
            return "Бұл пайдаланушы аты немесе электрондық пошта тіркелген!";
        }

        // Hash the password and insert user
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");

        try 
        {
            $stmt->execute([$username, $email, $passwordHash]);
            return true;
        } 
        catch (PDOException $e) 
        {
            return "Қате пайда болды: " . $e->getMessage();
        }
    }
}
