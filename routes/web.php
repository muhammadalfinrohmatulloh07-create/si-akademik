<?php
// routes/web.php
use app\Core\Middleware\AuthMiddleware;

// Inisialisasi middleware
$authMiddleware = new AuthMiddleware();

$routes = [
    'GET' => [
        '/'                 => ['HomeController', 'index'],
        '/login'            => ['AuthController', 'loginForm'],
        '/logout'           => ['AuthController', 'logout'],
        '/dashboard'        => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\HomeController())->dashboard();
        },
        '/mahasiswa'        => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\MahasiswaController())->index();
        },
        '/mahasiswa/create' => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\MahasiswaController())->create();
        },
        '/mahasiswa/edit'   => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\MahasiswaController())->edit();
        },
        '/mahasiswa/delete' => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\MahasiswaController())->delete();
        },
        '/prodi'            => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\ProdiController())->index();
        },
        '/matakuliah'       => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\MatakuliahController())->index();
        },
    ],
    'POST' => [
        '/login'            => ['AuthController', 'login'],
        '/mahasiswa'        => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\MahasiswaController())->store();
        },
        '/mahasiswa/update' => function() use ($authMiddleware) {
            $authMiddleware->handle();
            (new \App\Controllers\MahasiswaController())->update();
        },
    ]
];