<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';

$id = $_GET['id'];
$sql = "SELECT * FROM obat WHERE id = $id";
$result = $db_conn->query($sql);
$data = $result->fetch();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Obat</title>
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
        <h2>Detail Obat</h2>
        <a href="../index.php">KEMBALI</a>
        <br>
        <div class="row">
            <div class="label">Nama Obat</div>
            <div class="value"><?= $data['nama_obat'] ?: '-' ?></div>
        </div>

        <div class="row">
            <div class="label">Kategori</div>
            <div class="value"><?= $data['kategori_id'] ?: '-' ?></div>
        </div>

        <div class="row">
            <div class="label">Harga</div>
            <div class="value"><?= $data['harga'] ?: '-' ?></div>
        </div>

        <div class="row">
            <div class="label">Stok</div>
            <div class="value"><?= $data['stok'] ?: '-' ?></div>
        </div>

        <div class="row">
            <div class="label">Deskripsi</div>
            <div class="value"><?= $data['deskripsi'] ?: '-' ?></div>
        </div>
    </div>
</body>

</html>