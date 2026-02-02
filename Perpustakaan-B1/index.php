<?php
require 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

header(
    "Location: " .
    ($_SESSION['role'] === 'admin'
        ? 'dashboard_admin.php'
        : 'dashboard_anggota.php')
);