<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        echo "<h1>Halaman Utama</h1>";
        echo "<p>Selamat datang di Sistem Informasi Akademik.</p>";
        echo '<p><a href="/si-akademik/public/login">Login ke Sistem</a></p>';
    }

    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $flash = $_SESSION['flash'] ?? '';
        unset($_SESSION['flash']); // Ambil dan bersihkan flash message
        
        $username = $_SESSION['username'] ?? 'Admin';
        
        // Tampilkan view dashboard sederhana
        require_once __DIR__ . '/../Views/dashboard.php';
    }
}