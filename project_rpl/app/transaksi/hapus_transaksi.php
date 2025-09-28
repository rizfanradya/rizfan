<?php
// File: hapus_layanan.php
include 'koneksi.php';

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id_transaksi']);
    
    // Query untuk menghapus data
    $sql = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    
    if (mysqli_query($koneksi, $sql)) {
        // Jika berhasil, kembali ke halaman layanan
        header("Location: index.php?status=hapus_sukses");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
} else {
    // Jika tidak ada id, kembali ke halaman layanan
    header("Location: index.php");
}
?>