<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Apotek Mini</title>
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

        .judul {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="judul">Apotek Mini - PostgreSQL</h2>
        <br />
        <a href="../index.php">KEMBALI</a>
        <br />
        <h3>Tambah Data Kategori</h3>
        <form method="post" action="tambahKategori_aksi.php">
            <table>
                <tr>
                    <td>Nama Kategori</td>
                    <td><input type="text" name="nama_kategori" required placeholder="Nama Kategori"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Tambah"></td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>