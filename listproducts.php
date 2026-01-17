<?php
include 'koneksi.php'; // Sesuaikan path file koneksi Anda, misal config/koneksi.php

$data = mysqli_query($conn, "SELECT * FROM barang");

if (!$data) {
    die("Query error: " . mysqli_error($conn));
}
?>

<style>
.card {
    background: white;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
.btn {
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 4px;
    color: white;
    font-size: 14px;
}
.btn-tambah { background: #27ae60; }
.btn-edit { background: #2980b9; }
.btn-hapus { background: #c0392b; }

table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}
th { background: #f8f8f8; }
</style>

<div class="card">
    <div class="card-header">
        <h3>List Produk</h3>
        <a href="dashboard.php?page=tambah" class="btn btn-tambah">+ Tambah Produk</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        if (mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['kode_barang']); ?></td>
            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
            <td><?= htmlspecialchars($row['kategori']); ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td><?= $row['stok']; ?></td>
            <td><?= htmlspecialchars($row['satuan']); ?></td>
            <td>
                <a href="dashboard.php?page=edit&id=<?= $row['id_barang']; ?>" class="btn btn-edit">Edit</a>
                <a href="dashboard.php?page=hapus&id=<?= $row['id_barang']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php 
            }
        } else { 
        ?>
        <tr>
            <td colspan="8">Data produk belum tersedia atau tabel barang kosong.</td>
        </tr>
        <?php } ?>
    </table>
</div>