<?php
require 'config.php';
if ($_SESSION['role'] !== 'siswa') die("Akses ditolak");
?>

<h2>Dashboard Anggota</h2>
<ul>
    <li><a href="form_pinjam.php">📘 Pinjam Buku</a></li>
    <li><a href="form_kembali.php">📕 Kembalikan Buku</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>