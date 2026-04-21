<?php
include 'konek.php';

$id = $_GET['id'];

$sql = "DELETE FROM kategori WHERE id = $id";
$db_conn->query($sql);

header("location:index.php");
