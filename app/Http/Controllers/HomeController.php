<?php

declare(strict_types=1);

namespace App\Http\Controllers;

require_once __DIR__ . '/../../Core/Controller.php';

use App\Core\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        $kategoriList = $this->db->query('SELECT id, nama_kategori FROM kategori ORDER BY id ASC')->fetchAll();

        $obatSql = "SELECT obat.id, obat.nama_obat, obat.harga, obat.stok, obat.deskripsi, kategori.nama_kategori
                    FROM obat
                    JOIN kategori ON obat.kategori_id = kategori.id
                    ORDER BY obat.id ASC";
        $obatList = $this->db->query($obatSql)->fetchAll();

        $transaksiSql = "SELECT t.id,
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
        $transaksiList = $this->db->query($transaksiSql)->fetchAll();

        $this->view('home/index', [
            'kategoriList' => $kategoriList,
            'obatList' => $obatList,
            'transaksiList' => $transaksiList,
        ]);
    }
}
