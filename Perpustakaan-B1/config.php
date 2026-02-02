<?php
session_start();

$koneksi = new mysqli("localhost", "root", "", "perpus2");
if ($koneksi->connect_error) {
    die("Koneksi gagal");
}