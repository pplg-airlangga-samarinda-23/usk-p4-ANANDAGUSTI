<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$data = $koneksi->query("SELECT * FROM user WHERE role='siswa'");
?>

<h2>CRUD Anggota</h2>
<a href="create.php">Tambah Anggota</a><br><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    <?php while ($d = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['username'] ?></td>
            <td><?= $d['role'] ?></td>
            <td>
                <a href="edit.php?id=<?= $d['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $d['id'] ?>">Hapus</a>
            </td>
        </tr>
    <?php endwhile ?>
</table>

<br>
<a href="../dashboard_admin.php">🔙 Kembali ke Dashboard Admin</a>