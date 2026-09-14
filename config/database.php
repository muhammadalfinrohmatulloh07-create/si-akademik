<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            $host = 'localhost';
            $dbname = 'si_akademik';
            $username = 'root';
            $password = '';
            $charset = 'utf8mb4';
            $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

            // Jangan gunakan die(), biarkan PDOException dilempar (throw)
            self::$instance = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }
        return self::$instance;
    }
}