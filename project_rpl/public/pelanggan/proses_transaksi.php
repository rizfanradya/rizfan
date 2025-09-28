<?php
// [PERBAIKAN] Mulai sesi yang benar di semua file proses
session_name('PELANGGAN_SESSION');
session_start();

include '../../includes/koneksi.php';

// Autentikasi user
if (!isset($_SESSION['user_id'])) {
    // Jika sesi tidak ada, hentikan proses
    die("Akses tidak sah. Silakan login terlebih dahulu.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil id_user dari SESSION, ini sudah benar dan aman.
    $id_user = $_SESSION['user_id']; 
    
    $id_js = $_POST['id_js'];
    $id_layanan = $_POST['id_layanan'];
    $nama_pengirim = $_POST['nama_pengirim'];
    $nomor_pengirim = $_POST['nomor_pengirim'];
    $alamat_penjemputan = $_POST['alamat_penjemputan'];
    $nama_penerima = $_POST['nama_penerima'];
    $nomor_penerima = $_POST['nomor_penerima'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $jarak_km = $_POST['jarak_km'];
    
    // Validasi jarak di sisi server
    $query_layanan = "SELECT harga, jarak_min, jarak_max FROM jenis_layanan WHERE layanan_id = ?";
    $stmt_layanan = mysqli_prepare($koneksi, $query_layanan);
    mysqli_stmt_bind_param($stmt_layanan, "i", $id_layanan);
    mysqli_stmt_execute($stmt_layanan);
    $result_layanan = mysqli_stmt_get_result($stmt_layanan);
    $layanan = mysqli_fetch_assoc($result_layanan);
    
    if (!$layanan) { die("Error: Layanan tidak valid."); }

    if ($jarak_km < $layanan['jarak_min'] || $jarak_km > $layanan['jarak_max']) {
        header('Location: buat_transaksi.php?jasa_id='.$id_js.'&error=jarak');
        exit;
    }
    
    // Hitung total harga di sisi server
    $total_harga = $layanan['harga'] * $jarak_km;
    $status = 'Diproses';
    $tanggal_transaksi = date('Y-m-d H:i:s');

    $query = "INSERT INTO transaksi (id_user, id_js, id_layanan, nama_pengirim, nomor_pengirim, alamat_penjemputan, nama_penerima, nomor_penerima, alamat_tujuan, jarak_km, total_harga, status, tanggal_transaksi) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "iiissssssdsss", 
        $id_user, $id_js, $id_layanan, 
        $nama_pengirim, $nomor_pengirim, $alamat_penjemputan,
        $nama_penerima, $nomor_penerima, $alamat_tujuan, 
        $jarak_km, $total_harga, $status, $tanggal_transaksi);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?status=transaksi_sukses'); 
        exit;
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
}
?>