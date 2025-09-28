<?php
session_start();
include '../koneksi.php'; // Pastikan path ini benar

// Validasi dasar: Pastikan request adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// 1. Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Validasi: pastikan input tidak kosong
if (empty($username) || empty($password)) {
    header('Location: login.php?error=kosong');
    exit;
}

// 2. Query ke database untuk mengambil data user, TERMASUK STATUS
$query = "SELECT id_js, nama_js, username, password, status FROM nama_js WHERE username = ?";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// 3. Cek apakah username ditemukan
if ($result && mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
    
    // 4. Verifikasi password yang di-hash
    if (password_verify($password, $data['password'])) {
        
        // 5. PENGECEKAN STATUS AKUN (LANGKAH BARU)
        if ($data['status'] == 'aktif') {
            // Jika status 'aktif', buat session dan lanjutkan ke dasbor
            session_regenerate_id(true);
            
            $_SESSION['jasa_id'] = $data['id_js'];
            $_SESSION['nama_js'] = $data['nama_js'];
            
            header('Location: ../../public/mitra/index.php');
            exit;
        } else {
            // Jika status bukan 'aktif' (misalnya 'menunggu'), kembalikan ke login dengan error status
            header('Location: ../../public/mitra/login.php?error=status');
            exit;
        }
    }
}

// Jika username tidak ditemukan atau password salah, kembali ke login
header('Location: ../../public/mitra/login.php?error=gagal');
exit;
?>