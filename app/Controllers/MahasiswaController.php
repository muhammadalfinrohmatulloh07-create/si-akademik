<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\MahasiswaRepository;
use App\Services\MahasiswaService;
use App\Config\Database;
use PDOException;

class MahasiswaController extends Controller {
    private MahasiswaRepository $repo;
    private MahasiswaService $service;

    public function __construct() {
        try {
            $db = Database::getInstance();
            $this->repo = new MahasiswaRepository($db);
            $this->service = new MahasiswaService($this->repo);
        } catch (PDOException $e) {
            // Pencatatan log error ke file app.log
            error_log(
                date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL,
                3,
                __DIR__ . '/../../storage/logs/app.log'
            );

            http_response_code(500);
            echo "Terjadi gangguan pada sistem. Silahkan coba beberapa saat lagi.";
            exit;
        }
    }

    public function index() {
        $keyword = $_GET['keyword'] ?? null;
        $dataMahasiswa = $this->repo->all($keyword);

        $this->view('mahasiswa/index', ['dataMahasiswa' => $dataMahasiswa]);
    }

    public function show($id): void {
        $mhs = $this->repo->find($id);
        if ($mhs) {
            echo "<h1>Detail Mahasiswa</h1>";
            echo "<p>NIM: " . htmlspecialchars($mhs['nim']) . "</p>";
            echo "<p>Nama: " . htmlspecialchars($mhs['nama']) . "</p>";
            echo '<p><a href="/si-akademik/public/mahasiswa">Kembali</a></p>';
        } else {
            http_response_code(404);
            echo "Data mahasiswa tidak ditemukan";
        }
    }

    public function create() {
        $this->view('mahasiswa/create');
    }

    public function store(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $result = $this->service->create($_POST);
        if ($result['success']) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => $result['message']
            ];
            $this->redirect('/si-akademik/public/mahasiswa');
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => implode(", ", $result['errors'])
            ];
            $this->redirect('/si-akademik/public/mahasiswa/create');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/si-akademik/public/mahasiswa');
        }
        $mhs = $this->repo->find($id);
        $this->view('mahasiswa/edit', ['mhs' => $mhs]);
    }

    public function update(): void {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/si-akademik/public/mahasiswa');
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $result = $this->service->update($id, $_POST);
        if ($result['success']) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => $result['message']
            ];
            $this->redirect('/si-akademik/public/mahasiswa');
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => implode(", ", $result['errors'])
            ];
            $this->redirect('/si-akademik/public/mahasiswa/edit?id=' . $id);
        }
    }

    public function delete(): void {
        $id = $_GET['id'] ?? null;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($id) {
            $this->repo->delete($id);
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Data mahasiswa berhasil dihapus'
            ];
        }
        $this->redirect('/si-akademik/public/mahasiswa');
    }
}