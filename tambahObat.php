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
        <a href="index.php">KEMBALI</a>
        <br />
        <h3>Tambah Data Obat</h3>
        <form method="post" action="tambahObat_aksi.php">
            <table>
                <tr>
                    <td>Nama Obat</td>
                    <td><input type="text" name="nama_obat" required placeholder="Nama Obat"></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>
                        <select name="kategori_id" required>
                            <option value="">Pilih Kategori</option>
                            <?php
                            include 'konek.php';
                            $sql = "SELECT * FROM kategori";
                            $result = $db_conn->query($sql);
                            while ($row = $result->fetch()) {
                                echo "<option value='{$row['id']}'>{$row['nama_kategori']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="number" min="0" name="harga" required placeholder="Harga"></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><input type="number" name="stok" min="0" required placeholder="Stok"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" name="deskripsi" placeholder="Deskripsi"></td>
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