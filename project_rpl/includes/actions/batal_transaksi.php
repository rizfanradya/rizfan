<?php
// Memulai sesi yang benar untuk Pelanggan
session_name('PELANGGAN_SESSION');
session_start();

// Asumsi file koneksi.php berada satu level di atas folder 'actions' (di dalam 'includes')
include '../koneksi.php';

// Keamanan: Pastikan hanya pengguna yang sudah login yang bisa mengakses
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada sesi, hentikan eksekusi
    die("Akses tidak sah. Silakan login terlebih dahulu.");
}

// Pastikan request adalah POST dan id_transaksi dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_transaksi'])) {
    
    $id_transaksi = $_POST['id_transaksi'];
    $id_user = $_SESSION['user_id']; // Ambil ID pengguna dari sesi untuk keamanan

    // Query UPDATE yang aman untuk mengubah status menjadi 'Dibatalkan'
    // WHERE clause memastikan 3 hal:
    // 1. id_transaksi cocok dengan yang dikirim dari form.
    // 2. id_user cocok dengan pengguna yang sedang login (mencegah pembatalan pesanan orang lain).
    // 3. Status saat ini HARUS 'Diproses' (mencegah pembatalan pesanan yang sudah dikirim/selesai).
    $query = "UPDATE transaksi SET status = 'Dibatalkan' WHERE id_transaksi = ? AND id_user = ? AND status = 'Diproses'";
    
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ii", $id_transaksi, $id_user);

    // Eksekusi query dan cek apakah ada baris yang berhasil diubah
    if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
        // Jika berhasil, kembali ke halaman riwayat dengan pesan sukses
        header('Location: ../../public/pelanggan/riwayat.php?batal=sukses');
        exit;
    }
}

// Jika request bukan POST, atau jika query gagal, atau jika status bukan 'Diproses',
// kembalikan ke halaman riwayat dengan pesan gagal.
header('Location: ../../public/pelanggan/riwayat.php?batal=gagal');
exit;
?>