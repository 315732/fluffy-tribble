<?php
class Model {
    private static $pdo;

    public static function connect() {
        if (!self::$pdo) {
            self::$pdo = new PDO("mysql:host=localhost;dbname=course", "user", "password");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    public static function getMessage() {
        $stmt = self::connect()->query("SELECT 'Hello from the Model!' AS message");
        return $stmt->fetch(PDO::FETCH_ASSOC)['message'];
    }
}
