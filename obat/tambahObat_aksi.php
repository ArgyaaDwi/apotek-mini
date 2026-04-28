<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';

$namaObat = isset($_POST['nama_obat']) ? trim($_POST['nama_obat']) : '';
$kategoriId = isset($_POST['kategori_id']) ? (int) $_POST['kategori_id'] : 0;
$harga = isset($_POST['harga']) ? (float) $_POST['harga'] : 0;
$stok = isset($_POST['stok']) ? (int) $_POST['stok'] : 0;
$deskripsi = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';

if ($namaObat === '' || $kategoriId <= 0 || $harga < 0 || $stok < 0) {
    die('Data obat tidak valid. Stok dan harga tidak boleh minus.');
}

try {
    $sql = "INSERT INTO obat (nama_obat, kategori_id, harga, stok, deskripsi)
            VALUES (:nama_obat, :kategori_id, :harga, :stok, :deskripsi)";

    $stmt = $db_conn->prepare($sql);
    $stmt->execute([
        ':nama_obat' => $namaObat,
        ':kategori_id' => $kategoriId,
        ':harga' => $harga,
        ':stok' => $stok,
        ':deskripsi' => $deskripsi,
    ]);

    header('Location: ../index.php');
    exit;
} catch (Exception $e) {
    die('Gagal menambah obat: ' . $e->getMessage());
}