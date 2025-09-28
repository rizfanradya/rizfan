<?php
// [PERBAIKAN] Mulai sesi dengan nama yang benar agar konsisten
session_name('DEVELOPER_SESSION');
session_start();

// --- PENGATURAN KODE RAHASIA ---
define('DEVELOPER_SECRET_CODE', 'KodeDeveloperSuperAman');
// ---------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submitted_code = $_POST['secret_code'];

    if ($submitted_code === DEVELOPER_SECRET_CODE) {
        // Jika cocok, buat session khusus developer
        $_SESSION['developer_logged_in'] = true;
        
        // Arahkan ke dashboard khusus developer
        header('Location: index.php');
        exit;
    } else {
        // Jika salah, kembalikan ke halaman login dengan pesan error
        header('Location: login.php?error=1');
        exit;
    }
} else {
    // Jika file diakses langsung, tendang kembali ke login
    header('Location: login.php');
    exit;
}
?>