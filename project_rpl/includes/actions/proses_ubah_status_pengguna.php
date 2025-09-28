<?php
// [PERBAIKAN] Mulai sesi yang benar agar bisa mengakses session developer
session_name('DEVELOPER_SESSION');
session_start();

// Path ke file koneksi disesuaikan agar lebih robust
include dirname(__DIR__) . '/koneksi.php';

// Autentikasi Developer
if (!isset($_SESSION['developer_logged_in']) || $_SESSION['developer_logged_in'] !== true) {
    header('Location: ../../public/developer/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $tipe = $_POST['tipe'];
    $aksi = $_POST['aksi'];
    $status_baru = '';

    // Tentukan status baru berdasarkan aksi
    if ($aksi == 'aktifkan') {
        $status_baru = 'aktif';
    } elseif ($aksi == 'nonaktifkan') {
        // [PERUBAHAN] Status untuk menonaktifkan sekarang sama untuk semua tipe: 'tidak aktif'
        // Ini sesuai permintaan Anda untuk mengubah status nonaktif mitra.
        $status_baru = 'tidak aktif';
    }

    $table_name = '';
    $id_column = '';

    if ($tipe == 'pelanggan') {
        $table_name = 'users';
        $id_column = 'id_user';
    } elseif ($tipe == 'mitra') {
        $table_name = 'nama_js';
        $id_column = 'id_js';
    }

    // Lanjutkan hanya jika semua variabel valid
    if ($status_baru && $table_name && $id_column) {
        $query = "UPDATE $table_name SET status = ? WHERE $id_column = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "si", $status_baru, $id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../../public/developer/manajemen_pengguna.php?ubah_status=sukses');
            exit;
        }
    }
}

// Path redirect jika terjadi kegagalan
header('Location: ../../public/developer/manajemen_pengguna.php?ubah_status=gagal');
exit;
?>