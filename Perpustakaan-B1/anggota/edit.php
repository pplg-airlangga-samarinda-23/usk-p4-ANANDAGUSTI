<?php
require '../config.php';
if ($_SESSION['role'] !== 'admin') die("Akses ditolak");

$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM user WHERE id=$id")->fetch_assoc();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $cek = $koneksi->prepare("SELECT id FROM user WHERE username=? AND id!=?");
    $cek->bind_param("si", $username, $id);
    $cek->execute();

    if ($cek->get_result()->num_rows > 0) {
        $error = "Username sudah digunakan";
    } else {
        $stmt = $koneksi->prepare(
            "UPDATE user SET username=?,password=?,role=?
             WHERE id=?"
        );
        $stmt->bind_param("sssi", $username, $password, $role, $id);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}
?>

<h2>Edit Anggota</h2>
<p style="color:red"><?= $error ?></p>

<form method="post">
    Username: <input name="username" value="<?= $data['username'] ?>"><br>
    Password: <input type="password" name="password" value="<?= $data['password'] ?>"><br>
    Role:
    <select name="role">
        <option value="siswa" <?= $data['role'] === 'siswa' ? 'selected' : '' ?>>Siswa</option>
        <option value="admin" <?= $data['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br>
    <button>Simpan</button>
</form>

<br>
<a href="index.php">🔙 Kembali</a>