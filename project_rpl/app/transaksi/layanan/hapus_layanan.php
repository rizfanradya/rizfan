<?php
// File: hapus_layanan.php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_layanan = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query untuk menghapus data
    $sql = "DELETE FROM layanan WHERE id_layanan = '$id_layanan'";
    
    if (mysqli_query($koneksi, $sql)) {
        // Jika berhasil, kembali ke halaman layanan
        header("Location: layanan.php?status=hapus_sukses");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
} else {
    // Jika tidak ada id, kembali ke halaman layanan
    header("Location: layanan.php");
}
?>