<?php
// public/index.php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Core/Model.php';
require_once __DIR__ . '/../app/Core/Controller.php';
require_once __DIR__ . '/../app/Models/Mahasiswa.php';
require_once __DIR__ . '/../app/Models/MahasiswaRepository.php';
require_once __DIR__ . '/../app/Core/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/ProdiController.php';
require_once __DIR__ . '/../app/Controllers/MatakuliahController.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Services/MahasiswaService.php';
require_once __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = '/si-akademik/public';

if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

// 3. Cek rute statis dulu
if (isset($routes[$method][$uri])) {
    $route = $routes[$method][$uri];
    if (is_callable($route)) {
        $route();
    } else {
        [$controllerName, $action] = $route;
        $controllerClass = "App\\Controllers\\{$controllerName}";
        $controller = new $controllerClass();
        $controller->$action();
    }
    exit();
}

// 4. Cek pola URL dinamis: /mahasiswa/{id}
$segments = explode('/', trim($uri, '/'));
if ($method === 'GET' && count($segments) == 2 && $segments[0] === 'mahasiswa' && is_numeric($segments[1])) {
    $id = $segments[1];
    $controller = new \App\Controllers\MahasiswaController();
    $controller->show($id);
    exit();
}

// 5. Kalau tidak cocok sama sekali -> 404
http_response_code(404);
echo "404 - Halaman tidak ditemukan";