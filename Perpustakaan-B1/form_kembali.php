<?php
require 'config.php';
if ($_SESSION['role'] !== 'siswa') die("Akses ditolak");

$id_user = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pinjam = $_POST['pinjam'];
    $tgl = date('Y-m-d');

    $data = $koneksi->query(
        "SELECT id_buku FROM peminjaman WHERE id=$id_pinjam"
    )->fetch_assoc();

    $stmt = $koneksi->prepare(
        "UPDATE peminjaman SET tgl_kembali=? WHERE id=?"
    );
    $stmt->bind_param("si", $tgl, $id_pinjam);
    $stmt->execute();

    $stmt = $koneksi->prepare(
        "UPDATE buku SET status='tersedia' WHERE id=?"
    );
    $stmt->bind_param("i", $data['id_buku']);
    $stmt->execute();

    header("Location: dashboard_anggota.php");
    exit;
}

$data = $koneksi->query(
    "SELECT p.id, b.judul_buku
     FROM peminjaman p
     JOIN buku b ON p.id_buku=b.id
     WHERE p.id_user=$id_user AND p.tgl_kembali IS NULL"
);
?>

<h3>Form Pengembalian Buku</h3>

<form method="post">
    Pilih Buku:
    <select name="pinjam" required>
        <?php while ($d = $data->fetch_assoc()): ?>
            <option value="<?= $d['id'] ?>">
                <?= $d['judul_buku'] ?>
            </option>
        <?php endwhile ?>
    </select><br><br>

    <button>Kembalikan</button>
</form>

<br>
<a href="dashboard_anggota.php">🔙 Kembali</a>