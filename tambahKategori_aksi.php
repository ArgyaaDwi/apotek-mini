<?php
include 'konek.php';

$namaKategori = isset($_POST['nama_kategori']) ? trim($_POST['nama_kategori']) : '';

if ($namaKategori === '') {
    die('Nama kategori tidak boleh kosong.');
}

try {
    $sql = "INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)";

    $stmt = $db_conn->prepare($sql);
    $stmt->execute([':nama_kategori' => $namaKategori]);

    header('Location: index.php');
    exit;
} catch (Exception $e) {
    die('Gagal menambah kategori: ' . $e->getMessage());
}
