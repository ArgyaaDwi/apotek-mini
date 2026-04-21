<?php
include 'konek.php';

$namaKategori = $_POST['nama_kategori'];

$sql = "INSERT INTO kategori (nama_kategori) VALUES ('$namaKategori')";

$db_conn->query($sql);

header("location:index.php");
