<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM peminjaman WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['buku'];
    $id_user = $_POST['user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $stmt = $koneksi->prepare(
        "UPDATE peminjaman SET id_buku=?, id_user=?, tgl_pinjam=?, tgl_kembali=?
         WHERE id=?"
    );
    $stmt->bind_param("iissi", $id_buku, $id_user, $tgl_pinjam, $tgl_kembali, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$buku = $koneksi->query("SELECT * FROM buku");
$user = $koneksi->query("SELECT * FROM user WHERE role='siswa'");
?>

<h2>Edit Peminjaman</h2>

<form method="post">
    Pilih Buku:
    <select name="buku" required>
        <?php while ($b = $buku->fetch_assoc()): ?>
            <option value="<?= $b['id'] ?>" <?= $b['id'] == $data['id_buku'] ? 'selected' : '' ?>>
                <?= $b['judul_buku'] ?> - <?= $b['penulis'] ?>
            </option>
        <?php endwhile ?>
    </select><br><br>

    Pilih Peminjam:
    <select name="user" required>
        <?php while ($u = $user->fetch_assoc()): ?>
            <option value="<?= $u['id'] ?>" <?= $u['id'] == $data['id_user'] ? 'selected' : '' ?>>
                <?= $u['username'] ?>
            </option>
        <?php endwhile ?>
    </select><br><br>

    Tanggal Pinjam: <input type="date" name="tgl_pinjam" value="<?= $data['tgl_pinjam'] ?>" required><br><br>

    Tanggal Kembali: <input type="date" name="tgl_kembali" value="<?= $data['tgl_kembali'] ?>"><br><br>

    <button>Simpan</button>
</form>

<br>
<a href="index.php">🔙 Kembali</a>