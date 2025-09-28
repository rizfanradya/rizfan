<?php
// Memulai sesi KHUSUS untuk pelanggan
session_name('PELANGGAN_SESSION');
session_start();

// Jika sudah login sebagai pelanggan, langsung ke dasbor
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

include '../../includes/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_identifier = $_POST['login_identifier'];
    $password = $_POST['password'];

    if (!empty($login_identifier) && !empty($password)) {
        $query = "SELECT id_user, username, password, status FROM users WHERE email = ? OR username = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ss", $login_identifier, $login_identifier);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                if ($user['status'] == 'aktif') {
                    $_SESSION['user_id'] = $user['id_user'];
                    $_SESSION['username_pelanggan'] = $user['username'];
                    header("location: index.php");
                    exit;
                } else {
                    header("location: login.php?error=status");
                    exit;
                }
            }
        }
    }
    header("location: login.php?error=gagal");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background-color: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); text-align: center; width: 100%; max-width: 400px; }
        .login-box .logo { max-width: 100px; margin-bottom: 20px; }
        .login-box h2 { font-weight: 600; color: #1F2937; }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="../assets/img/logo_kitapaketin_aksen_segar.png" alt="Logo Aplikasi" class="logo">
        <h2 class="h4 mb-4">Login Pelanggan</h2>
        <?php
        if (isset($_GET['error'])) {
            $pesan = '';
            if ($_GET['error'] == 'gagal') {
                $pesan = 'Email/Username atau Password Salah!';
            } elseif ($_GET['error'] == 'status') {
                $pesan = 'Akun Anda tidak aktif atau sedang ditinjau.';
            }
            echo '<div class="alert alert-danger">'.htmlspecialchars($pesan).'</div>';
        }
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo '<div class="alert alert-success">'.htmlspecialchars($_GET['message']).'</div>';
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="login_identifier" name="login_identifier" placeholder="Email atau Username" required>
                <label for="login_identifier">Email atau Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2 fw-bold">LOGIN</button>
        </form>
        <div class="mt-3"><small>Belum punya akun? <a href="register.php">Daftar di sini</a></small></div>
        <div class="mt-2"><small><a href="../login.php">« Kembali ke pilihan login</a></small></div>
    </div>
</body>
</html>