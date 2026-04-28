<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';

$ID = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$namaKategori = isset($_POST['nama_kategori']) ? trim($_POST['nama_kategori']) : '';

if ($ID <= 0 || $namaKategori === '') {
    die('Data kategori tidak valid.');
}

try {
    $sql = "UPDATE kategori SET nama_kategori = :nama_kategori WHERE id = :id";

    $stmt = $db_conn->prepare($sql);
    $stmt->execute([
        ':nama_kategori' => $namaKategori,
        ':id' => $ID,
    ]);

    header('Location: ../index.php');
    exit;
} catch (Exception $e) {
    die('Gagal mengupdate kategori: ' . $e->getMessage());
}