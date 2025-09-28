<?php
// Ini akan menjadi SATU-SATUNYA tempat sesi untuk Mitra dimulai.
// Pastikan tidak ada spasi atau output apa pun sebelum baris ini.
session_name('MITRA_SESSION');
session_start();

// Cek sesi mitra. Jika tidak ada, tendang ke halaman login.
if (!isset($_SESSION['jasa_id'])) {
    header('Location: login.php');
    exit;
}

// Mengambil nama file yang sedang aktif untuk navigasi jika diperlukan di masa depan.
$nama_file_aktif = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Dasbor Mitra'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
        <img src="../assets/img/logo_kitapaketin_aksen_segar.png" alt="Logo K" class="navbar-logo-img">
        <span>Dasbor Mitra</span>
    </a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <span class="navbar-text me-3">Selamat Datang, <strong><?php echo htmlspecialchars($_SESSION['nama_js']); ?></strong>!</span>
      </li>
      <li class="nav-item">
        <a class="btn btn-danger btn-sm" href="../logout.php?role=mitra">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container py-4">