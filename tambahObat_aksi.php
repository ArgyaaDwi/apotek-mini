<?php
include 'konek.php';

$namaObat = $_POST['nama_obat'];
$kategoriId = $_POST['kategori_id'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

$sql = "INSERT INTO obat (nama_obat, kategori_id, harga, stok, deskripsi)
VALUES ('$namaObat', $kategoriId, $harga, $stok, '$deskripsi')";

$db_conn->query($sql);

header("location:index.php");
