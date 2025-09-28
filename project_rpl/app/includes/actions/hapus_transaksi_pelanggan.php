<?php
// hapus_transaksi_pelanggan.php
session_name('PELANGGAN_SESSION');
session_start();

// [PENTING] Nonaktifkan proses penghapusan
// File ini sekarang hanya berfungsi untuk mencegah penghapusan data.

// Autentikasi: Pastikan hanya user yang login yang bisa menghapus
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../pelanggan/login.php');
    exit;
}

// Redirect dengan pesan bahwa penghapusan tidak diizinkan
header('Location: ../../public/pelanggan/riwayat.php?hapus=nonaktif&pesan=Penghapusan%20riwayat%20transaksi%20tidak%20diizinkan.');
exit;
?>