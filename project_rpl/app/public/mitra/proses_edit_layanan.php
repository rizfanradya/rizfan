<?php
// [PERBAIKAN] Mulai sesi yang benar di semua file proses
session_name('MITRA_SESSION');
session_start();

include '../../includes/koneksi.php';

// Autentikasi Mitra
if (!isset($_SESSION['jasa_id'])) {
    die("Akses tidak sah.");
}
$jasa_id = $_SESSION['jasa_id'];

// Cek apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil semua data dari form
    $layanan_id = $_POST['layanan_id'];
    $nama_layanan = $_POST['nama_layanan'];
    $deskripsi = $_POST['deskripsi'];
    $estimasi = $_POST['estimasi_waktu'];
    $harga = $_POST['harga'];
    $jarak_min = $_POST['jarak_min'];
    $jarak_max = $_POST['jarak_max'];

    if (!empty($layanan_id) && !empty($nama_layanan) && !empty($estimasi) && !empty($harga) && !empty($jarak_max)) {
        $query = "UPDATE jenis_layanan SET 
                    nama_layanan = ?, deskripsi = ?, estimasi_waktu = ?, 
                    harga = ?, jarak_min = ?, jarak_max = ? 
                  WHERE layanan_id = ? AND jasa_id = ?";
        
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssddiii", 
            $nama_layanan, $deskripsi, $estimasi, 
            $harga, $jarak_min, $jarak_max, 
            $layanan_id, $jasa_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?edit=sukses');
            exit;
        }
    }
}

header('Location: index.php?edit=gagal');
exit;
?>