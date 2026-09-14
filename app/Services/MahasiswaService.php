<?php
namespace App\Services;

use App\Models\Mahasiswa;
use App\Models\MahasiswaRepository;

class MahasiswaService {
    private MahasiswaRepository $repo;

    public function __construct(MahasiswaRepository $repo) {
        $this->repo = $repo;
    }

    public function create(array $input): array {
        $errors = $this->validate($input);
        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $mhs = new Mahasiswa(null, $input['nim'], $input['nama'], $input['email'], (int)$input['prodi_id'], (int)$input['angkatan'], $input['status']);
        $this->repo->create($mhs);

        return [
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan'
        ];
    }

    public function update($id, array $input): array {
        $errors = $this->validate($input, $id);
        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $mhs = new Mahasiswa($id, $input['nim'], $input['nama'], $input['email'], (int)$input['prodi_id'], (int)$input['angkatan'], $input['status']);
        $this->repo->update($id, $mhs);

        return [
            'success' => true,
            'message' => 'Data mahasiswa berhasil diubah'
        ];
    }

    private function validate(array $input, $excludeId = null): array {
        $errors = [];
        
        if (empty(trim($input['nim'] ?? ''))) {
            $errors['nim'] = 'NIM wajib diisi';
        } elseif ($this->repo->existsByNim($input['nim'], $excludeId)) {
            $errors['nim'] = 'NIM sudah terdaftar';
        }

        if (empty(trim($input['nama'] ?? ''))) {
            $errors['nama'] = 'Nama wajib diisi';
        }

        return $errors;
    }
}