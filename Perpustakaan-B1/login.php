<?php
require 'config.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $u = $res->fetch_assoc();
        if ($_POST['password'] === $u['password']) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $u['id'];
            $_SESSION['role'] = $u['role'];
            header("Location: index.php");
            exit;
        }
    }
    $error = "Username atau password salah";
}
?>

<h3>Login</h3>
<p style="color:red"><?= $error ?></p>

<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    <button>Login</button>
</form>

<br>
<a href="register.php">Daftar</a>