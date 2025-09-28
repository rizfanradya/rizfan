<?php
// [PERBAIKAN] Mulai sesi yang benar agar bisa mengakses session developer
session_name('DEVELOPER_SESSION');
session_start();

include '../../includes/koneksi.php';

// Keamanan: Pastikan hanya developer yang bisa mengakses
if (!isset($_SESSION['developer_logged_in']) || $_SESSION['developer_logged_in'] !== true) {
    die("Akses ditolak.");
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id_js = (int)$_GET['id'];
    $action = $_GET['action'];
    $new_status = '';

    if ($action == 'approve') {
        $new_status = 'aktif';
    } elseif ($action == 'reject') {
        $new_status = 'tidak aktif';
    }

    if ($new_status) {
        $query = "UPDATE nama_js SET status = ? WHERE id_js = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "si", $new_status, $id_js);
        
        if(mysqli_stmt_execute($stmt)){
            header('Location: index.php?konfirmasi=sukses');
            exit;
        }
    }
}

// Jika gagal, kembali ke dashboard developer
header('Location: index.php?konfirmasi=gagal');
exit;
?>