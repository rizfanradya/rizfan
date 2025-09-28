<?php

include '../../includes/templates/header_pelanggan.php';

include '../../includes/koneksi.php';

// Autentikasi
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_transaksi = $_POST['id_transaksi'];
    $id_js = $_POST['id_js'];
    $rating = $_POST['rating'];
    $komentar = $_POST['komentar'];
    // DIUBAH: Ambil id_user dari session untuk keamanan
    $id_user = $_SESSION['user_id']; 

    // Validasi dasar
    if (empty($id_transaksi) || empty($id_js) || empty($rating)) {
        header('Location: index.php?ulasan=gagal');
        exit;
    }

    // Query INSERT ke tabel ulasan
    $query = "INSERT INTO ulasan (id_transaksi, id_user, id_js, rating, komentar) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "iiiis", $id_transaksi, $id_user, $id_js, $rating, $komentar);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?ulasan=sukses');
        exit;
    } else {
        // Handle error (kemungkinan karena sudah pernah memberi ulasan untuk transaksi ini)
        header('Location: index.php?ulasan=gagal');
        exit;
    }
}
?>