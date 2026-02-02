<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM buku WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];

    $stmt = $koneksi->prepare(
        "UPDATE buku SET judul_buku=?,penulis=?,penerbit=?,tahun_terbit=?,status=?
         WHERE id=?"
    );
    $stmt->bind_param("sssisi", $judul, $penulis, $penerbit, $tahun, $status, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<h2>Edit Buku</h2>
<form method="post">
    Judul Buku: <input name="judul" value="<?= $data['judul_buku'] ?>"><br>
    Penulis: <input name="penulis" value="<?= $data['penulis'] ?>"><br>
    Penerbit: <input name="penerbit" value="<?= $data['penerbit'] ?>"><br>
    Tahun Terbit: <input name="tahun" type="number" value="<?= $data['tahun_terbit'] ?>"><br>
    Status:
    <select name="status">
        <option value="tersedia" <?= $data['status'] === 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
        <option value="tidak" <?= $data['status'] === 'tidak' ? 'selected' : '' ?>>Tidak Tersedia</option>
    </select><br>
    <button>Simpan</button>
</form>

<br>
<a href="index.php">🔙 Kembali</a>