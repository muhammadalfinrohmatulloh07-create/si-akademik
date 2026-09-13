<?php
namespace App\Controllers;

use App\Config\Database;
use PDO;

class MatakuliahController {
    public function index() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM matakuliah");
        $dataMatakuliah = $stmt->fetchAll(PDO::FETCH_ASSOC); // <-- Tambahkan simbol $ di sini

        require_once __DIR__ . '/../Views/matakuliah/index.php';
    }
}