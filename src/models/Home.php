<?php 

require_once "core/Database.php";

class Home
{
    public static function contact($firstname, $lastname, $email, $message)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("INSERT INTO contacts (firstname, lastname, email, content) VALUES (:firstname, :lastname, :email, :message)");

        try 
        {
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } 
        catch (PDOException $e) 
        {
            error_log("Database Error: " . $e->getMessage(), 3, "logs/errors.log"); // Log error
            return false;
        }
    }
}
