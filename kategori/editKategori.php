<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';
$id = $_GET['id'];
$sql = "SELECT * FROM kategori WHERE id = $id";
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
            <h3>Edit Kategori</h3>
            <form method="post" action="updateKategori.php">
                <table>
                    <tr>
                        <td>Nama Kategori</td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="nama_kategori" value="<?php echo htmlspecialchars($row['nama_kategori']); ?>" required>
                        </td>
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