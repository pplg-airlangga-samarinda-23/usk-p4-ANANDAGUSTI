<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$result = $koneksi->query("SELECT * FROM buku");
?>

<h3>CRUD Buku</h3>
<a href="create.php">Tambah Buku</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['judul_buku']) ?></td>
        <td><?= htmlspecialchars($row['penulis']) ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id'] ?>" 
               onclick="return confirm('Hapus buku ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="../dashboard_admin.php">🔙 Kembali ke Dashboard Admin</a>
