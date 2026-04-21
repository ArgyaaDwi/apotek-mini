<?php

include 'konek.php';

$ID = $_POST['id'];
$namaObat = $_POST['nama_obat'];
$kategoriId = $_POST['kategori_id'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

$sql = "UPDATE obat SET nama_obat='$namaObat', kategori_id='$kategoriId', harga='$harga', stok='$stok', deskripsi='$deskripsi' WHERE id = $ID";
$result = $db_conn->query($sql);

header("location:index.php");
