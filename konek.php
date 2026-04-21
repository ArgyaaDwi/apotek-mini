<?php
$host = "localhost";
$port = "5432";
$db   = "apotek-mini";
$user = "postgres";
$pass = "Argyadwi123_";

try {
    $db_conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
