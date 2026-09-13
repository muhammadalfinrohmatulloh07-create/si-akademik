<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use Exception;

class MahasiswaModel {

    // Menampilkan semua data mahasiswa dengan relasi JOIN ke tabel prodi
    public static function all($keyword = null) {
        $db = Database::getInstance();
        if ($keyword) {
            $stmt = $db->prepare("SELECT m.*, p.nama AS prodi_nama 
                                   FROM mahasiswa m 
                                   JOIN prodi p ON m.prodi_id = p.id 
                                   WHERE m.nama LIKE :keyword1 OR m.nim LIKE :keyword2 
                                   ORDER BY m.nim");
            // Karena ada 2 placeholder (:keyword1 dan :keyword2), kirimkan kedua nilainya
            $stmt->execute([
                'keyword1' => "%$keyword%", 
                'keyword2' => "%$keyword%"
            ]);
        } else {
            $stmt = $db->query("SELECT m.*, p.nama AS prodi_nama 
                                  FROM mahasiswa m 
                                  JOIN prodi p ON m.prodi_id = p.id 
                                  ORDER BY m.nim");
        }
        return $stmt->fetchAll();
    }

    // Mencari mahasiswa berdasarkan ID
    public static function find($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Menyimpan data mahasiswa baru (Create)
    public static function create($data) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status) VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)");
        return $stmt->execute([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'prodi_id' => $data['prodi_id'],
            'angkatan' => $data['angkatan'],
            'status' => $data['status']
        ]);
    }

    // Memperbarui data mahasiswa (Update)
    public static function update($id, $data) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id, angkatan = :angkatan, status = :status WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'prodi_id' => $data['prodi_id'],
            'angkatan' => $data['angkatan'],
            'status' => $data['status']
        ]);
    }

    // Menghapus data mahasiswa (Delete)
    public static function delete($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Contoh Implementasi Transaction
    public static function contohTransaction($dataMahasiswa) {
        $pdo = Database::getInstance();
        try {
            $pdo->beginTransaction();
            
            // Contoh query utama (Insert Mahasiswa)
            $stmt = $pdo->prepare("INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status) VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)");
            $stmt->execute($dataMahasiswa);

            // Jika ada query lanjutan (misal insert log atau relasi lain), taruh di sini

            // Jika semua Berhasil
            $pdo->commit();
            return true;
        } catch (Exception $e) {
            // Jika ada kesalahan, batalkan semua perubahan
            $pdo->rollBack();
            throw $e;
        }
    }
}