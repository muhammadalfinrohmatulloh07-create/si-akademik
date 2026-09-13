<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRepository;
use App\Config\Database;

class MahasiswaController extends Controller {
    private MahasiswaRepository $repo;

    public function __construct() {
        $db = Database::getInstance();
        $this->repo = new MahasiswaRepository($db);
    }

    public function index() {
        $keyword = $_GET['keyword'] ?? null;
        $dataMahasiswa = $this->repo->all($keyword);
        
        $this->view('mahasiswa/index', ['dataMahasiswa' => $dataMahasiswa]);
    }

    public function create() {
        $this->view('mahasiswa/create');
    }

    public function store(): void {
        $nim = trim($_POST['nim'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);
        $angkatan = (int)($_POST['angkatan'] ?? date('Y'));
        $status = $_POST['status'] ?? 'aktif';

        try {
            $mhs = new Mahasiswa(null, $nim, $nama, $email, $prodi_id, $angkatan, $status);
            $this->repo->create($mhs);                          
            $this->redirect('/si-akademik/public/mahasiswa');
        } catch (\Exception $e) {
            die("<script>alert('" . $e->getMessage() . "'); window.history.back();</script>");
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
        
        $nim = trim($_POST['nim'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);
        $angkatan = (int)($_POST['angkatan'] ?? date('Y'));
        $status = $_POST['status'] ?? 'aktif';

        try {
            $mhs = new Mahasiswa($id, $nim, $nama, $email, $prodi_id, $angkatan, $status);
            $this->repo->update($id, $mhs);
            $this->redirect('/si-akademik/public/mahasiswa');
        } catch (\Exception $e) {
            die("<script>alert('" . $e->getMessage() . "'); window.history.back();</script>");
        }
    }

    public function delete(): void {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->repo->delete($id);
        }
        $this->redirect('/si-akademik/public/mahasiswa');
    }
}