<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$id = $_GET['id'];
$koneksi->query("DELETE FROM buku WHERE id=$id");
header("Location: index.php");
exit;