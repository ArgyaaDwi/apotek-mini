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
        <a href="kategori/tambahKategori.php">Tambah Kategori</a>
        <br />
        <h3>Data Kategori</h3>
        <table border="1" class="tabel">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php $noKategori = 1; ?>
            <?php foreach ($kategoriList as $kategori): ?>
                <tr>
                    <td><?php echo $noKategori++; ?></td>
                    <td><?php echo htmlspecialchars((string) $kategori['nama_kategori']); ?></td>
                    <td>
                        <a href="kategori/editKategori.php?id=<?php echo (int) $kategori['id']; ?>" style="color:coral">Edit</a>
                        <a href="kategori/deleteKategori.php?id=<?php echo (int) $kategori['id']; ?>"
                            onclick="return confirm('Yakin mau hapus kategori ini?')"
                            style="color:red;">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br />
        <br>
        <a href="obat/tambahObat.php">Tambah Obat</a>
        <br />
        <h3>Data Obat</h3>
        <table border="1" class="tabel">
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
            <?php $noObat = 1; ?>
            <?php foreach ($obatList as $obat): ?>
                <tr>
                    <td><?php echo $noObat++; ?></td>
                    <td><?php echo htmlspecialchars((string) $obat['nama_obat']); ?></td>
                    <td><?php echo htmlspecialchars((string) $obat['nama_kategori']); ?></td>
                    <td><?php echo htmlspecialchars((string) $obat['harga']); ?></td>
                    <td><?php echo htmlspecialchars((string) $obat['stok']); ?></td>
                    <td><?php echo htmlspecialchars((string) $obat['deskripsi']); ?></td>
                    <td>
                        <a href="obat/detailObat.php?id=<?php echo (int) $obat['id']; ?>" style="color: blue;">Detail</a>
                        <a href="obat/editObat.php?id=<?php echo (int) $obat['id']; ?>" style="color:coral">Edit</a>
                        <a href="obat/deleteObat.php?id=<?php echo (int) $obat['id']; ?>"
                            onclick="return confirm('Yakin mau hapus data ini?')"
                            style="color:red;">
                            Hapus
                        </a>
                    </td>
                    <td>
                        <a href="transaksi/beli.php?id=<?php echo (int) $obat['id']; ?>" style="color:green;">Beli</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br />
        <h3>Data Transaksi</h3>
        <table border="1" class="tabel">
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
            <?php $noTransaksi = 1; ?>
            <?php foreach ($transaksiList as $transaksi): ?>
                <tr>
                    <td><?php echo $noTransaksi++; ?></td>
                    <td><?php echo htmlspecialchars((string) ($transaksi['tanggal_tampil'] ?? '-')); ?></td>
                    <td><?php echo htmlspecialchars((string) $transaksi['nama_pembeli']); ?></td>
                    <td><?php echo htmlspecialchars((string) $transaksi['nama_obat']); ?></td>
                    <td><?php echo htmlspecialchars((string) $transaksi['jumlah']); ?></td>
                    <td><?php echo htmlspecialchars((string) $transaksi['harga']); ?></td>
                    <td><?php echo htmlspecialchars((string) $transaksi['subtotal']); ?></td>
                    <td>
                        <a href="transaksi/detailTransaksi.php?id=<?php echo (int) $transaksi['id']; ?>" style="color: blue;">Detail</a>
                        <a href="transaksi/deleteTransaksi.php?id=<?php echo (int) $transaksi['id']; ?>"
                            onclick="return confirm('Yakin mau hapus transaksi ini?')"
                            style="color:red;">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>