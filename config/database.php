<?php
namespace App\Config;

use PDO;
use PDOException;

class Database 
{ 
    private static ?PDO $instance = null; 
    
    public static function getInstance(): PDO 
    { 
        if (self::$instance === null) { 
            // Konfigurasi koneksi langsung atau sesuaikan
            $host = 'localhost';
            $dbname = 'si_akademik';
            $username = 'root';
            $password = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}"; 
            
            try {
                self::$instance = new PDO($dsn, $username, $password, [ 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                    PDO::ATTR_EMULATE_PREPARES => false, 
                ]); 
            } catch (PDOException $e) {
                die("Koneksi database gagal: " . $e->getMessage());
            }
        } 
        return self::$instance; 
    } 
}