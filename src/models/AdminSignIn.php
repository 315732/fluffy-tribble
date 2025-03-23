<?php 

require_once "core/Database.php";

class AdminSignIn 
{
    public static function signin(string $usernamneOrEmail, string $password)
    {
        $pdo = Database::connect();
        $query = "SELECT id, username, email, password_hash FROM admins WHERE " .
                 (filter_var($usernamneOrEmail, FILTER_VALIDATE_EMAIL) ? "email" : "username") . " = ?";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$usernamneOrEmail]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) 
        {
            session_start();
            $_SESSION = [
                'admin_session' => true,
                'admin_id'      => $user['id'],
                'admin_name'    => $user['username'],
                'user_email'    => $user['email']
            ];
            return true;
        }
    }
}