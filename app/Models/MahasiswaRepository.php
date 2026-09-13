<?php
namespace App\Models;

use PDO;

class MahasiswaRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function all(?string $keyword = null): array {
        if ($keyword) {
            $stmt = $this->db->prepare("SELECT m.*, p.nama AS prodi_nama 
                                          FROM mahasiswa m 
                                          JOIN prodi p ON m.prodi_id = p.id 
                                          WHERE m.nama LIKE :keyword1 OR m.nim LIKE :keyword2 
                                          ORDER BY m.nim");
            $stmt->execute([
                'keyword1' => "%$keyword%", 
                'keyword2' => "%$keyword%"
            ]);
        } else {
            $stmt = $this->db->query("SELECT m.*, p.nama AS prodi_nama 
                                        FROM mahasiswa m 
                                        JOIN prodi p ON m.prodi_id = p.id 
                                        ORDER BY m.nim");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $data : null;
    }

    public function create(Mahasiswa $mhs): bool {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status) VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)");
        return $stmt->execute([
            'nim' => $mhs->getNim(),
            'nama' => $mhs->getNama(),
            'email' => $mhs->getEmail(),
            'prodi_id' => $mhs->getProdiId(),
            'angkatan' => $mhs->getAngkatan(),
            'status' => $mhs->getStatus()
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
            'status' => $mhs->getStatus()
        ]);
    }

    public function delete($id): bool {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}