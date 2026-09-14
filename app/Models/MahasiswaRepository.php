<?php
namespace App\Models;

use PDO;
use App\Models\Mahasiswa;

class MahasiswaRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function all(?string $keyword = null): array {
        $query = "SELECT m.*, p.nama AS prodi_nama FROM mahasiswa m LEFT JOIN prodi p ON m.prodi_id = p.id";
        if ($keyword) {
            $query .= " WHERE m.nim LIKE :kw1 OR m.nama LIKE :kw2";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'kw1' => "%$keyword%",
                'kw2' => "%$keyword%"
            ]);
        } else {
            $stmt = $this->db->query($query);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(Mahasiswa $mhs): bool {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status) VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)");
        return $stmt->execute([
            'nim' => $mhs->getNim(),
            'nama' => $mhs->getNama(),
            'email' => $mhs->getEmail(),
            'prodi_id' => $mhs->getProdiId(),
            'angkatan' => $mhs->getAngkatan(),
            'status' => $mhs->getStatus(),
        ]);
    }

    public function update($id, Mahasiswa $mhs): bool {
        $stmt = $this->db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id, angkatan = :angkatan, status = :status WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nim' => $mhs->getNim(),
            'nama' => $mhs->getNama(),
            'email' => $mhs->getEmail(),
            'prodi_id' => $mhs->getProdiId(),
            'angkatan' => $mhs->getAngkatan(),
            'status' => $mhs->getStatus(),
        ]);
    }

    public function delete($id): bool {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function existsByNim(string $nim, ?int $excludeId = null): bool {
        $query = "SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim";
        $params = ['nim' => $nim];
        
        if ($excludeId) {
            $query .= " AND id != :id";
            $params['id'] = $excludeId;
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }
}