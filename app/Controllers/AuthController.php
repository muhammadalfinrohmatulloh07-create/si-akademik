<?php
namespace App\Controllers;

class AuthController {
    
    // Menampilkan form login
    public function loginForm() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Jika sudah login, langsung lempar ke dashboard
        if (!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            header('Location: /si-akademik/public/dashboard');
            exit;
        }

        // Tampilkan view login (atau form sederhana)
        $flash = $_SESSION['flash'] ?? '';
        unset($_SESSION['flash']); // Hapus flash message setelah dibaca
        
        // Menggunakan view atau template langsung
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    // Proses login (Hardcode username & password sesuai modul)
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Simulasi login sukses (Hardcode: admin / password123)
        if ($username === 'admin' && $password === 'password123') {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            
            // Tugas Mandiri: Flash message login sukses
            $_SESSION['flash'] = 'Selamat datang, Admin';
            
            header('Location: /si-akademik/public/dashboard');
            exit;
        } else {
            $_SESSION['flash'] = 'Username atau password salah!';
            header('Location: /si-akademik/public/login');
            exit;
        }
    }

    // Proses logout
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Hapus session terkait login
        unset($_SESSION['logged_in']);
        unset($_SESSION['username']);
        
        // Tugas Mandiri: Flash message setelah logout
        $_SESSION['flash'] = 'Anda telah logout';
        
        header('Location: /si-akademik/public/login');
        exit;
    }
}