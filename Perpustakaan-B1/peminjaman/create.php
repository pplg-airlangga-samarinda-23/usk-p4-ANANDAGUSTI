<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['buku'];
    $id_user = $_POST['user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    $stmt = $koneksi->prepare(
        "INSERT INTO peminjaman (id_buku, id_user, tgl_pinjam)
         VALUES (?, ?, ?)"
    );
    $stmt->bind_param("iis", $id_buku, $id_user, $tgl_pinjam);
    $stmt->execute();

    $stmt = $koneksi->prepare(
        "UPDATE buku SET status='tidak' WHERE id=?"
    );
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

$buku = $koneksi->query("SELECT * FROM buku WHERE status='tersedia'");
$user = $koneksi->query("SELECT * FROM user WHERE role='siswa'");
?>

<h2>Tambah Peminjaman</h2>

<form method="post">
    Pilih Buku:
    <select name="buku" required>
        <?php while ($b = $buku->fetch_assoc()): ?>
            <option value="<?= $b['id'] ?>">
                <?= $b['judul_buku'] ?> - <?= $b['penulis'] ?>
            </option>
        <?php endwhile ?>
    </select><br><br>

    Pilih Peminjam:
    <select name="user" required>
        <?php while ($u = $user->fetch_assoc()): ?>
            <option value="<?= $u['id'] ?>">
                <?= $u['username'] ?>
            </option>
        <?php endwhile ?>
    </select><br><br>

    Tanggal Pinjam: <input type="date" name="tgl_pinjam" required><br><br>

    <button>Simpan</button>
</form>

<br>
<a href="index.php">🔙 Kembali</a>