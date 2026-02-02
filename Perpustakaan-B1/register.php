<?php
require 'config.php';
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
             VALUES (?, ?, 'siswa')"
        );
        $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
        $stmt->execute();
        header("Location: login.php");
        exit;
    }
}
?>

<h3>Register</h3>
<p style="color:red"><?= $error ?></p>

<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    <button>Daftar</button>
</form>

<br>
<a href="login.php">🔙 Kembali ke Login</a>