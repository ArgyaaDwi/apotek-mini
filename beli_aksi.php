<?php
include 'konek.php';

$obat_id = isset($_POST['obat_id']) ? (int) $_POST['obat_id'] : 0;
$nama = isset($_POST['nama_pembeli']) ? trim($_POST['nama_pembeli']) : '';
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
$jumlah = isset($_POST['jumlah']) ? (int) $_POST['jumlah'] : 0;

if ($obat_id <= 0 || $jumlah <= 0 || $nama === '' || $alamat === '') {
    die("Data pembelian tidak valid.");
}

try {
    $db_conn->beginTransaction();

    // Kunci baris obat agar stok aman saat transaksi bersamaan.
    $stmtObat = $db_conn->prepare("SELECT id, stok, harga FROM obat WHERE id = :id FOR UPDATE");
    $stmtObat->execute([':id' => $obat_id]);
    $obat = $stmtObat->fetch(PDO::FETCH_ASSOC);

    if (!$obat) {
        throw new Exception("Data obat tidak ditemukan.");
    }

    if ($jumlah > (int) $obat['stok']) {
        throw new Exception("Stok tidak cukup!");
    }

    $stmtTransaksi = $db_conn->prepare("INSERT INTO transaksi (nama_pembeli, alamat) VALUES (:nama, :alamat) RETURNING id");
    $stmtTransaksi->execute([
        ':nama' => $nama,
        ':alamat' => $alamat,
    ]);
    $transaksi_id = $stmtTransaksi->fetchColumn();

    $stmtDetail = $db_conn->prepare("INSERT INTO transaksi_detail (transaksi_id, obat_id, jumlah, harga) VALUES (:transaksi_id, :obat_id, :jumlah, :harga)");
    $stmtDetail->execute([
        ':transaksi_id' => $transaksi_id,
        ':obat_id' => $obat_id,
        ':jumlah' => $jumlah,
        ':harga' => $obat['harga'],
    ]);

    $stmtUpdateStok = $db_conn->prepare("UPDATE obat SET stok = stok - :jumlah WHERE id = :id AND stok >= :jumlah");
    $stmtUpdateStok->execute([
        ':jumlah' => $jumlah,
        ':id' => $obat_id,
    ]);

    if ($stmtUpdateStok->rowCount() !== 1) {
        throw new Exception("Gagal update stok. Silakan coba lagi.");
    }

    $db_conn->commit();
    header("Location: index.php");
    exit;
} catch (Exception $e) {
    if ($db_conn->inTransaction()) {
        $db_conn->rollBack();
    }
    die($e->getMessage());
}
