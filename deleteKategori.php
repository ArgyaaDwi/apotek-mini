<?php
include 'konek.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die('ID kategori tidak valid.');
}

try {
    $db_conn->beginTransaction();

    $stmtDeleteDetail = $db_conn->prepare("DELETE FROM transaksi_detail td USING obat o WHERE td.obat_id = o.id AND o.kategori_id = :id");
    $stmtDeleteDetail->execute([':id' => $id]);

    $stmtDeleteObat = $db_conn->prepare("DELETE FROM obat WHERE kategori_id = :id");
    $stmtDeleteObat->execute([':id' => $id]);

    $db_conn->exec("DELETE FROM transaksi t WHERE NOT EXISTS (SELECT 1 FROM transaksi_detail td WHERE td.transaksi_id = t.id)");
    $stmtDeleteKategori = $db_conn->prepare("DELETE FROM kategori WHERE id = :id");
    $stmtDeleteKategori->execute([':id' => $id]);

    $db_conn->commit();
} catch (Exception $e) {
    if ($db_conn->inTransaction()) {
        $db_conn->rollBack();
    }
    die('Gagal menghapus kategori: ' . $e->getMessage());
}

header('Location: index.php');
exit;
