<?php
session_start();
include '../koneksi.php'; // Sesuaikan path jika perlu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Ambil data dari form
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $no_telepon = trim($_POST['no_telepon']);
    $alamat = trim($_POST['alamat']);
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // 2. Siapkan array untuk menampung error validasi
    $errors = [];

    // 3. Lakukan validasi format dan kelengkapan (tidak berubah)
    if (empty($nama_lengkap)) { $errors[] = "Nama lengkap wajib diisi."; }
    if (empty($username)) { $errors[] = "Username wajib diisi."; } 
    elseif (!ctype_alnum($username)) { $errors[] = "Username hanya boleh berisi huruf dan angka."; }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Format email tidak valid."; }
    if (strlen($password) < 8) { $errors[] = "Password harus memiliki minimal 8 karakter."; }
    if (!preg_match('/^[0-9]{10,15}$/', $no_telepon)) { $errors[] = "Nomor telepon tidak valid (hanya 10-15 digit angka)."; }
    if (empty($alamat)) { $errors[] = "Alamat wajib diisi."; }
    if (empty($tanggal_lahir)) { $errors[] = "Tanggal lahir wajib diisi."; }

    // Jika ada error format, langsung kembalikan
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        $_SESSION['register_input'] = $_POST;
        header('Location: ../../public/pelanggan/register.php');
        exit;
    }

    // =======================================================
    // DITAMBAHKAN: Langkah 4 - Cek duplikasi email & username SEBELUM INSERT
    // =======================================================
    $query_cek = "SELECT id_user FROM users WHERE email = ? ";
    $stmt_cek = mysqli_prepare($koneksi, $query_cek);
    mysqli_stmt_bind_param($stmt_cek, "s", $email);
    mysqli_stmt_execute($stmt_cek);
    $result_cek = mysqli_stmt_get_result($stmt_cek);

    if (mysqli_num_rows($result_cek) > 0) {
        // Jika ditemukan data yang sama
        $errors[] = "Email sudah terdaftar. Silakan gunakan yang lain.";
    }
    
    // Cek lagi apakah ada error dari proses pengecekan duplikasi
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        $_SESSION['register_input'] = $_POST;
        header('Location: ../../public/pelanggan/register.php');
        exit;
    }
    
    // 5. Jika semua pengecekan lolos, baru lakukan INSERT
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query_insert = "INSERT INTO users (nama_lengkap, username, email, password, no_telepon, alamat, tanggal_lahir) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $query_insert);
    mysqli_stmt_bind_param($stmt_insert, "sssssss", $nama_lengkap, $username, $email, $hashedPassword, $no_telepon, $alamat, $tanggal_lahir);

    if (mysqli_stmt_execute($stmt_insert)) {
        // Jika insert berhasil
        header('Location: ../../public/pelanggan/login.php?status=success&message=Pendaftaran berhasil! Silakan login.');
        exit;
    } else {
        // Jika ada error lain saat insert
        $errors[] = "Terjadi kesalahan pada server. Silakan coba lagi.";
        $_SESSION['register_errors'] = $errors;
        $_SESSION['register_input'] = $_POST;
        header('Location: ../../public/pelanggan/register.php');
        exit;
    }
}
?>