<?php
// Memulai sesi yang benar untuk Mitra
session_name('MITRA_SESSION');
session_start();

include '../../includes/koneksi.php';

// Autentikasi: Pastikan hanya mitra yang login yang bisa mengakses
if (!isset($_SESSION['jasa_id'])) {
    die("Akses tidak sah. Silakan login kembali.");
}

// Cek apakah data yang dibutuhkan dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['layanan_id']) && isset($_POST['aksi'])) {
    $layanan_id = $_POST['layanan_id'];
    $aksi = $_POST['aksi'];
    $jasa_id = $_SESSION['jasa_id']; // Ambil ID mitra dari sesi untuk keamanan
    $status_baru = '';

    // Tentukan status baru berdasarkan aksi yang dikirim
    if ($aksi == 'aktifkan') {
        $status_baru = 'Aktif';
    } elseif ($aksi == 'nonaktifkan') {
        $status_baru = 'Tidak Aktif';
    }

    // Lanjutkan hanya jika status baru valid
    if ($status_baru) {
        // Query UPDATE yang aman, memastikan mitra hanya bisa mengubah layanannya sendiri
        $query = "UPDATE jenis_layanan SET status_layanan = ? WHERE layanan_id = ? AND jasa_id = ?";
        
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sii", $status_baru, $layanan_id, $jasa_id);

        if (mysqli_stmt_execute($stmt)) {
            // Jika berhasil, kembali ke dasbor dengan pesan sukses
            header('Location: index.php?status_layanan_ubah=sukses');
            exit;
        }
    }
}

// Jika gagal karena alasan apapun, kembali dengan pesan gagal
header('Location: index.php?status_layanan_ubah=gagal');
exit;
?>