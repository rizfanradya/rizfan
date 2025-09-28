<?php
session_start();
include '../koneksi.php'; // Hubungkan ke database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_identifier = $_POST['login_identifier'];
    $password = $_POST['password'];

    if (!empty($login_identifier) && !empty($password)) {
        // DIUBAH: Query sekarang juga mengambil 'username'
        $query = "SELECT id_user, username, password, status FROM users WHERE email = ? OR username = ?";
        
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ss", $login_identifier, $login_identifier);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                if ($user['status'] == 'aktif') {
                    // Login berhasil, buat session
                    $_SESSION['user_id'] = $user['id_user'];
                    // DIUBAH: Simpan 'username' ke session, bukan 'nama_lengkap'
                    $_SESSION['username_pelanggan'] = $user['username']; 
                    
                    header("location: ../../public/pelanggan/dashboard.php");
                    exit;
                } else {
                    header("location: ../../public/pelanggan/login.php?error=status");
                    exit;
                }
            }
        }
    }
    header("location: ../../public/pelanggan/login.php?error=gagal");
    exit;
}
?>