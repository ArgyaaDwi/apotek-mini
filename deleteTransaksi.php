<?php
include 'konek.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die('ID transaksi tidak valid.');
}

try {
    $db_conn->beginTransaction();

    $stmtDetail = $db_conn->prepare("SELECT obat_id, jumlah FROM transaksi_detail WHERE transaksi_id = :id FOR UPDATE");
    $stmtDetail->execute([':id' => $id]);
    $details = $stmtDetail->fetchAll(PDO::FETCH_ASSOC);

    $stmtTambahStok = $db_conn->prepare("UPDATE obat SET stok = stok + :jumlah WHERE id = :obat_id");
    foreach ($details as $detail) {
        $stmtTambahStok->execute([
            ':jumlah' => (int) $detail['jumlah'],
            ':obat_id' => (int) $detail['obat_id'],
        ]);
    }

    $stmtDeleteDetail = $db_conn->prepare("DELETE FROM transaksi_detail WHERE transaksi_id = :id");
    $stmtDeleteDetail->execute([':id' => $id]);

    $stmtDeleteTransaksi = $db_conn->prepare("DELETE FROM transaksi WHERE id = :id");
    $stmtDeleteTransaksi->execute([':id' => $id]);

    $db_conn->commit();
} catch (Exception $e) {
    if ($db_conn->inTransaction()) {
        $db_conn->rollBack();
    }
    die('Gagal menghapus transaksi: ' . $e->getMessage());
}

header('Location: index.php');
exit;
