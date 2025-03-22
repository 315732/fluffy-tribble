<?php

require_once "core/Database.php";

class SignIn 
{
    public static function signin(string $usernameOrEmail, string $password): bool|string 
    {
        $pdo = Database::connect();
        $query = "SELECT id, username, email, password_hash FROM users WHERE " .
                 (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) ? "email" : "username") . " = ?";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$usernameOrEmail]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) 
        {
            session_start();
            $_SESSION = [
                'user_session' => true,
                'user_id'      => $user['id'],
                'user_name'    => $user['username'],
                'user_email'   => $user['email']
            ];
            return true;
        }
        return "Қате пайдаланушы аты/электрондық пошта немесе құпиясөз!";
    }
}
