<!DOCTYPE html>
<html>

<head>
    <title>Apotek Mini</title>
    <link rel="stylesheet" href="css/global.css">
</head>

<body>
    <div class="container">
        <h2 class="judul">Apotek Mini - PostgreSQL</h2>
        <br />
        <?php include 'konek.php'; ?>
        <br />
        <a href="tambahKategori.php">Tambah Kategori</a>
        <br />
        <h3>Data Kategori</h3>
        <table border='1' class="tabel">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php
            $noKategori = 1;
            $sqlKategori = "SELECT id, nama_kategori FROM kategori ORDER BY id ASC";
            $resultKategori = $db_conn->query($sqlKategori);
            while ($kategori = $resultKategori->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $noKategori++; ?></td>
                    <td><?php echo htmlspecialchars($kategori['nama_kategori']); ?></td>
                    <td>

                        <a href="editKategori.php?id=<?php echo $kategori['id']; ?>" style="color:coral">Edit</a>
                        <a href="deleteKategori.php?id=<?php echo $kategori['id']; ?>"
                            onclick="return confirm('Yakin mau hapus kategori ini?')"
                            style="color:red;">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br />
        <br>
        <a href="tambahObat.php">Tambah Obat</a>
        <br />
        <h3>Data Obat</h3>
        <table border='1' class="tabel">
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
                <th>Beli</th>
            </tr>
            <?php
            $noObat = 1;
            $sqlObat = "SELECT obat.id, obat.nama_obat, obat.harga, obat.stok, obat.deskripsi, kategori.nama_kategori
                        FROM obat
                        JOIN kategori ON obat.kategori_id = kategori.id
                        ORDER BY obat.id ASC";
            $resultObat = $db_conn->query($sqlObat);
            while ($obat = $resultObat->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $noObat++; ?></td>
                    <td><?php echo htmlspecialchars($obat['nama_obat']); ?></td>
                    <td><?php echo htmlspecialchars($obat['nama_kategori']); ?></td>
                    <td><?php echo htmlspecialchars($obat['harga']); ?></td>
                    <td><?php echo htmlspecialchars($obat['stok']); ?></td>
                    <td><?php echo htmlspecialchars($obat['deskripsi']); ?></td>
                    <td>
                        <a href="detailObat.php?id=<?php echo $obat['id']; ?>" style="color: blue;">Detail</a>
                        <a href="editObat.php?id=<?php echo $obat['id']; ?>" style="color:coral">Edit</a>
                        <a href="deleteObat.php?id=<?php echo $obat['id']; ?>"
                            onclick="return confirm('Yakin mau hapus data ini?')"
                            style="color:red;">
                            Hapus
                        </a>
                    </td>
                    <td>
                        <a href="beli.php?id=<?php echo $obat['id']; ?>" style="color:green;">Beli</a>

                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <br />
        <h3>Data Transaksi</h3>
        <table border='1' class="tabel">
            <tr>
                <th>No</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
            <?php
            $noTransaksi = 1;
            $sqlTransaksi = "SELECT t.id,
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
                             ORDER BY t.id DESC";
            $resultTransaksi = $db_conn->query($sqlTransaksi);

            while ($transaksi = $resultTransaksi->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $noTransaksi++; ?></td>
                    <td><?php echo htmlspecialchars($transaksi['tanggal_tampil'] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($transaksi['nama_pembeli']); ?></td>
                    <td><?php echo htmlspecialchars($transaksi['nama_obat']); ?></td>
                    <td><?php echo htmlspecialchars($transaksi['jumlah']); ?></td>
                    <td><?php echo htmlspecialchars($transaksi['harga']); ?></td>
                    <td><?php echo htmlspecialchars($transaksi['subtotal']); ?></td>
                    <td>
                        <a href="detailTransaksi.php?id=<?php echo $transaksi['id']; ?>" style="color: blue;">Detail</a>
                        <a href="deleteTransaksi.php?id=<?php echo $transaksi['id']; ?>"
                            onclick="return confirm('Yakin mau hapus transaksi ini?')"
                            style="color:red;">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>