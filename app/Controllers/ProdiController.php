<?php
namespace App\Controllers;

use App\Config\Database;
use PDO;

class ProdiController {
    public function index() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM prodi");
        $dataProdi = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../Views/prodi/index.php';
    }
}