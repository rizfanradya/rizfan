<?php
// [PERBAIKAN] Mulai sesi yang benar
session_name('MITRA_SESSION');
session_start();

include '../../includes/koneksi.php';

// Autentikasi
if (!isset($_SESSION['jasa_id'])) {
    die("Akses tidak sah.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $status_baru = $_POST['status_baru'];
    $jasa_id = $_SESSION['jasa_id'];

    if (!empty($id_transaksi) && !empty($status_baru)) {
        $query = "UPDATE transaksi SET status = ? WHERE id_transaksi = ? AND id_js = ?";
        
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sii", $status_baru, $id_transaksi, $jasa_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?update=sukses');
            exit;
        }
    }
}
header('Location: index.php?update=gagal');
exit;
?>