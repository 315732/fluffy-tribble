<?php

class Database 
{
    private static ?PDO $pdo = null;

    private function __construct() {} // Prevent instantiation

    public static function connect(): PDO 
    {
        if (!self::$pdo) 
        {
            try 
            {
                self::$pdo = new PDO(
                    "mysql:host=localhost;dbname=course;charset=utf8mb4", 
                    "user", 
                    "password", 
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } 
            catch (PDOException $e) 
            {
                die("Database connection error: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
