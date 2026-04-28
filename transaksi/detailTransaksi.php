<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT t.id,
               to_char(t.tanggal, 'YYYY-MM-DD HH24:MI') AS tanggal_tampil,
               t.nama_pembeli,
               t.alamat,
               o.nama_obat,
               td.jumlah,
               td.harga,
               (td.jumlah * td.harga) AS subtotal
        FROM transaksi t
        JOIN transaksi_detail td ON t.id = td.transaksi_id
        JOIN obat o ON o.id = td.obat_id
        WHERE t.id = :id";

$stmt = $db_conn->prepare($sql);
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die('Data transaksi tidak ditemukan.');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Transaksi</title>
    <style>
        body {
            font-family: Poppins;
        }

        .container {
            border: 1px solid lightgray;
            width: 600px;
            margin: auto;
            padding: 20px;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
        }

        .label {
            width: 200px;
            font-weight: bold;
        }

        .value {
            flex: 1;
        }

        h2 {
            text-align: center;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Transaksi</h2>
        <a href="../index.php">KEMBALI</a>
        <br>

        <div class="row">
            <div class="label">Tanggal</div>
            <div class="value"><?= htmlspecialchars($data['tanggal_tampil'] ?? '-') ?></div>
        </div>

        <div class="row">
            <div class="label">Nama Pembeli</div>
            <div class="value"><?= htmlspecialchars($data['nama_pembeli'] ?? '-') ?></div>
        </div>

        <div class="row">
            <div class="label">Alamat</div>
            <div class="value"><?= htmlspecialchars($data['alamat'] ?? '-') ?></div>
        </div>

        <div class="row">
            <div class="label">Nama Obat</div>
            <div class="value"><?= htmlspecialchars($data['nama_obat'] ?? '-') ?></div>
        </div>

        <div class="row">
            <div class="label">Jumlah</div>
            <div class="value"><?= htmlspecialchars((string) ($data['jumlah'] ?? '-')) ?></div>
        </div>

        <div class="row">
            <div class="label">Harga</div>
            <div class="value"><?= htmlspecialchars((string) ($data['harga'] ?? '-')) ?></div>
        </div>

        <div class="row">
            <div class="label">Subtotal</div>
            <div class="value"><?= htmlspecialchars((string) ($data['subtotal'] ?? '-')) ?></div>
        </div>
    </div>
</body>

</html>