<?php
// Ini akan menjadi SATU-SATUNYA tempat sesi dimulai untuk halaman pelanggan
// Pastikan tidak ada spasi atau output apa pun sebelum baris ini.
session_name('PELANGGAN_SESSION');
session_start();

// Cek apakah pengguna sudah login. Jika tidak, langsung tendang ke halaman login.
// Ini menghilangkan kebutuhan untuk memeriksa sesi di setiap halaman lain.
if (!isset($_SESSION['user_id'])) {
    // Arahkan ke login.php yang berada di folder 'pelanggan'
    // Path ini relatif dari lokasi file yang memanggil header ini.
    header('Location: login.php');
    exit;
}

// Mengambil nama file yang sedang aktif untuk menyorot menu navigasi
$nama_file_aktif = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Kitapaketin'; // Menggunakan variabel $page_title dari halaman pemanggil ?></title>
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
        <span>itapaketin</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if($nama_file_aktif == 'index.php') echo 'active fw-bold'; ?>" href="index.php">Pesan Sekarang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($nama_file_aktif == 'riwayat.php') echo 'active fw-bold'; ?>" href="riwayat.php">Riwayat Pesanan</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <span class="navbar-text me-3">Halo, <strong><?php echo htmlspecialchars($_SESSION['username_pelanggan']); ?></strong>!</span>
        </li>
        <li class="nav-item">
           <a class="btn btn-danger btn-sm" href="../logout.php?role=pelanggan">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-4">