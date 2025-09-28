<?php
// Ini akan menjadi SATU-SATUNYA tempat sesi untuk Developer dimulai.
session_name('DEVELOPER_SESSION');
session_start();

// Cek sesi developer. Jika tidak ada, tendang ke halaman login.
if (!isset($_SESSION['developer_logged_in']) || $_SESSION['developer_logged_in'] !== true) {
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
    <title><?php echo $page_title ?? 'Dasbor Developer'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
        <i class="bi bi-code-slash me-2"></i>
        <span>Developer Dasbor</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#devNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="devNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($nama_file_aktif == 'index.php') echo 'active'; ?>" href="index.php">Konfirmasi Pendaftar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($nama_file_aktif == 'manajemen_pengguna.php') echo 'active'; ?>" href="manajemen_pengguna.php">Manajemen Pengguna</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <span class="navbar-text me-3">Selamat Datang, <strong>Developer</strong>!</span>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger btn-sm" href="../logout.php?role=developer">Logout</a>
          </li>
        </ul>
    </div>
  </div>
</nav>