<?php
session_name('MITRA_SESSION');
session_start();
include '../koneksi.php';

// Autentikasi: Pastikan hanya mitra yang login yang bisa menghapus
if (!isset($_SESSION['jasa_id'])) {
    header('Location: login.php');
    exit;
}

// Cek apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $jasa_id = $_SESSION['jasa_id']; // ID mitra dari session

    if (!empty($id_transaksi)) {
        // Query DELETE yang aman dengan prepared statement
        // Memastikan mitra hanya bisa menghapus transaksi miliknya yang statusnya 'Dibatalkan'
        $query = "DELETE FROM transaksi WHERE id_transaksi = ? AND id_js = ? AND status = 'Dibatalkan'";
        
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ii", $id_transaksi, $jasa_id);

        if (mysqli_stmt_execute($stmt)) {
            // Cek apakah ada baris yang terhapus
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Jika berhasil, kembalikan ke dasbor dengan pesan sukses
                header('Location: index.php?hapus=sukses');
                exit;
            }
        }
    }
}

// Jika gagal karena alasan apapun, kembalikan dengan pesan gagal
header('Location: index.php?hapus=gagal');
exit;
?>