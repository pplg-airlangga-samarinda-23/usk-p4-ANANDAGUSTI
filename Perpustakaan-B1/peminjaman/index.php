<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$data = $koneksi->query(
    "SELECT p.id, b.judul_buku, u.username, p.tgl_pinjam, p.tgl_kembali
     FROM peminjaman p
     JOIN buku b ON p.id_buku = b.id
     JOIN user u ON p.id_user = u.id"
);
?>

<h2>Manajemen Peminjaman</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Judul Buku</th>
        <th>Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Aksi</th>
    </tr>
    <?php while ($d = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['judul_buku'] ?></td>
            <td><?= $d['username'] ?></td>
            <td><?= $d['tgl_pinjam'] ?></td>
            <td><?= $d['tgl_kembali'] ?: 'Belum Kembali' ?></td>
            <td>
                <a href="edit.php?id=<?= $d['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $d['id'] ?>">Hapus</a>
            </td>
        </tr>
    <?php endwhile ?>
</table>

<br>
<a href="../dashboard_admin.php">🔙 Kembali ke Dashboard Admin</a>