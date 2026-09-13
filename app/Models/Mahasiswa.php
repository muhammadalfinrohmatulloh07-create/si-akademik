<?php
namespace App\Models;

use InvalidArgumentException;

class Mahasiswa {
    private ?int $id;
    private string $nim;
    private string $nama;
    private string $email;
    private int $prodiId;
    private int $angkatan;
    private string $status;

    public function __construct(?int $id = null, string $nim = '', string $nama = '', string $email = '', int $prodiId = 0, int $angkatan = 0, string $status = 'aktif') {
        $this->id = $id;
        $this->setNim($nim);
        $this->setNama($nama);
        $this->setEmail($email);
        $this->prodiId = $prodiId;
        $this->angkatan = $angkatan;
        $this->status = $status;
    }

    // --- GETTERS ---
    public function getId(): ?int { return $this->id; }
    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getEmail(): string { return $this->email; }
    public function getProdiId(): int { return $this->prodiId; }
    public function getAngkatan(): int { return $this->angkatan; }
    public function getStatus(): string { return $this->status; }

    // --- SETTERS DENGAN VALIDASI ---
    public function setNim(string $nim): void {
        if (trim($nim) === '') {
            throw new InvalidArgumentException("Validasi Gagal: NIM tidak boleh kosong.");
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void {
        if (trim($nama) === '') {
            throw new InvalidArgumentException("Validasi Gagal: Nama mahasiswa tidak boleh kosong.");
        }
        // Validasi tambahan: Menolak jika nama mengandung angka
        if (preg_match('/[0-9]/', $nama)) {
            throw new InvalidArgumentException("Validasi Gagal: Nama mahasiswa tidak boleh mengandung angka.");
        }
        $this->nama = $nama;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setProdiId(int $prodiId): void {
        $this->prodiId = $prodiId;
    }

    public function setAngkatan(int $angkatan): void {
        $this->angkatan = $angkatan;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }
}