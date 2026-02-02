<?php
require 'config.php';
if ($_SESSION['role'] !== 'siswa') die("Akses ditolak");

$id_user = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['buku'];
    $tgl = date('Y-m-d');

    $stmt = $koneksi->prepare(
        "INSERT INTO peminjaman (id_buku,id_user,tgl_pinjam)
         VALUES (?,?,?)"
    );
    $stmt->bind_param("iis", $id_buku, $id_user, $tgl);
    $stmt->execute();

    $stmt = $koneksi->prepare(
        "UPDATE buku SET status='tidak' WHERE id=?"
    );
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();

    header("Location: dashboard_anggota.php");
    exit;
}

$buku = $koneksi->query("SELECT * FROM buku WHERE status='tersedia'");
?>

<h3>Form Peminjaman Buku</h3>

<form method="post">
    Pilih Buku:
    <select name="buku" required>
        <?php while ($b = $buku->fetch_assoc()): ?>
            <option value="<?= $b['id'] ?>">
                <?= $b['judul_buku'] ?> - <?= $b['penulis'] ?>
            </option>
        <?php endwhile ?>
    </select><br><br>

    <button>Pinjam</button>
</form>

<br>
<a href="dashboard_anggota.php">🔙 Kembali</a>