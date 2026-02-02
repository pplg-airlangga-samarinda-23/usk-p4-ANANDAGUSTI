<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];

    $stmt = $koneksi->prepare(
        "INSERT INTO buku (judul_buku, penulis) VALUES (?, ?)"
    );
    $stmt->bind_param("ss", $judul, $penulis);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<h3>Tambah Buku</h3>

<form method="post">
    Judul Buku: <input name="judul" required><br>
    Penulis: <input name="penulis" required><br>
    <button>Simpan</button>
</form>

<br>
<a href="index.php">🔙 Kembali</a>
