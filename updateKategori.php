<?php

include 'konek.php';

$ID = $_POST['id'];
$namaKategori = $_POST['nama_kategori'];

$sql = "UPDATE kategori SET nama_kategori='$namaKategori' WHERE id = $ID";
$result = $db_conn->query($sql);

header("location:index.php");
