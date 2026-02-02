<?php
require 'config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");
?>

<h2>Dashboard Admin</h2>
<ul>
    <li><a href="buku/index.php">CRUD Buku</a></li>
    <li><a href="anggota/index.php">CRUD Anggota</a></li>
    <li><a href="peminjaman/index.php">Manajemen Peminjaman</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>