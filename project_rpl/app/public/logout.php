<?php
// Ambil peran dari URL, contoh: logout.php?role=pelanggan
$role = $_GET['role'] ?? '';

// Atur nama sesi yang sesuai dengan peran sebelum memulai sesi
if ($role === 'pelanggan') {
    session_name('PELANGGAN_SESSION');
} elseif ($role === 'mitra') {
    session_name('MITRA_SESSION');
} elseif ($role === 'developer') {
    session_name('DEVELOPER_SESSION');
}

// Mulai sesi yang spesifik untuk dihancurkan
session_start();
// Hapus semua variabel sesi
session_unset();
// Hancurkan file sesi di server
session_destroy();

// Arahkan kembali ke halaman portal login utama
header('Location: login.php?status=logout_sukses');
exit;
?>