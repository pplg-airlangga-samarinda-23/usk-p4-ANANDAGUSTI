<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cek = $koneksi->prepare("SELECT id FROM user WHERE username=?");
    $cek->bind_param("s", $_POST['username']);
    $cek->execute();

    if ($cek->get_result()->num_rows > 0) {
        $error = "Username sudah digunakan";
    } else {
        $stmt = $koneksi->prepare(
            "INSERT INTO user (username,password,role)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $_POST['username'], $_POST['password'], $_POST['role']);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}
?>

<h2>Tambah Anggota</h2>
<p style="color:red"><?= $error ?></p>

<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    Role:
    <select name="role">
        <option value="siswa">Siswa</option>
        <option value="admin">Admin</option>
    </select><br>
    <button>Simpan</button>
</form>

<br>
<a href="index.php">🔙 Kembali</a>