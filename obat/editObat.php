<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';

$id = $_GET['id'];
$sql = "SELECT * FROM obat WHERE id = $id";
$result = $db_conn->query($sql);
while ($row = $result->fetch()) {
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
            <h3>Edit Obat</h3>
            <form method="post" action="update.php">
                <table>
                    <tr>
                        <td>Nama Obat</td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="nama_obat" value="<?php echo $row['nama_obat']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>
                            <select name="kategori_id">
                                <?php
                                $kategori_sql = "SELECT id, nama_kategori FROM kategori";
                                $kategori_result = $db_conn->query($kategori_sql);
                                while ($kategori_row = $kategori_result->fetch()) {
                                    $selected = ($kategori_row['id'] == $row['kategori_id']) ? 'selected' : '';
                                    echo "<option value='{$kategori_row['id']}' $selected>{$kategori_row['nama_kategori']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input type="number" name="harga" min="0" value="<?php echo $row['harga']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td><input type="number" name="stok" min="0" value="<?php echo $row['stok']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td><input type="text" name="deskripsi" value="<?php echo $row['deskripsi'] ?? ''; ?>"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="SIMPAN"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>

    </html>
    <?php
}