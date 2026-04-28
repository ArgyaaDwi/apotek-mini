<?php

declare(strict_types=1);

namespace App\Http\Controllers;

require_once __DIR__ . '/../../Core/Controller.php';

use App\Core\Controller;

final class KategoriController extends Controller
{
    public function create(): void
    {
        $this->view('kategori/create');
    }

    public function store(array $input): void
    {
        $namaKategori = isset($input['nama_kategori']) ? trim((string) $input['nama_kategori']) : '';

        if ($namaKategori === '') {
            die('Nama kategori tidak boleh kosong.');
        }

        try {
            $stmt = $this->db->prepare('INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)');
            $stmt->execute([':nama_kategori' => $namaKategori]);

            header('Location: index.php');
            exit;
        } catch (\Throwable $e) {
            die('Gagal menambah kategori: ' . $e->getMessage());
        }
    }
}
