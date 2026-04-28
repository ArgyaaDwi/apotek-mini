<?php

declare(strict_types=1);

require_once __DIR__ . '/../konek.php';

// Temporary debugging: show errors to help diagnose why this page fails when clicked.
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $db_conn->prepare("SELECT id, nama_obat, stok FROM obat WHERE id = :id");
$stmt->execute([':id' => $id]);
$obat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$obat) {
    die("Data obat tidak ditemukan.");
}

$stok = (int) $obat['stok'];
?>

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
        <a href="../index.php">KEMBALI</a>
        <br />
        <h3>Beli Obat</h3>
        <form method="post" action="beli_aksi.php">
            <input type="hidden" name="obat_id" value="<?php echo htmlspecialchars((string) $obat['id']); ?>">

            <table>
                <tr>
                    <td>Nama Obat</td>
                    <td><b><?php echo htmlspecialchars((string) $obat['nama_obat']); ?></b></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><?php echo htmlspecialchars((string) $obat['stok']); ?></td>
                </tr>
                <tr>
                    <td>Nama Pembeli</td>
                    <td><input type="text" name="nama_pembeli" required></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" required></td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>
                        <input type="number" name="jumlah" min="1" max="<?php echo $stok; ?>" required <?php echo $stok < 1 ? 'disabled' : ''; ?>>
                        <?php if ($stok < 1) { ?>
                            <small style="color:red;">Stok habis, tidak bisa melakukan pembelian.</small>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Beli" <?php echo $stok < 1 ? 'disabled' : ''; ?>></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>