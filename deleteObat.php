<?php
include 'konek.php';

$id = $_GET['id'];

$sql = "DELETE FROM obat WHERE id = $id";
$db_conn->query($sql);

header("location:index.php");
