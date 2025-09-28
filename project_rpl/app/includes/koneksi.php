<?php
// File: koneksi.php

$host = "";
$username = "root";
$password = "";
$database = "jasaantarbarang";

// Membuat koneksi menggunakan MySQLi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengatur zona waktu jika perlu
date_default_timezone_set('Asia/Jakarta');
