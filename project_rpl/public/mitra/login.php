<?php
// Memulai sesi KHUSUS untuk mitra
session_name('MITRA_SESSION');
session_start();
include '../../includes/koneksi.php';

// Logika proses login HANYA berjalan jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... (Logika proses login Anda yang sudah benar, tidak perlu diubah) ...
    $username_mitra = $_POST['username'];
    $password_mitra = $_POST['password'];
    if (!empty($username_mitra) && !empty($password_mitra)) {
        $query = "SELECT id_js, nama_js, password, status FROM nama_js WHERE username = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $username_mitra);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) == 1) {
            $jasa = mysqli_fetch_assoc($result);
            if (password_verify($password_mitra, $jasa['password'])) {
                if ($jasa['status'] == 'aktif') {
                    $_SESSION['jasa_id'] = $jasa['id_js'];
                    $_SESSION['nama_js'] = $jasa['nama_js'];
                    header("location: index.php");
                    exit;
                } else {
                     $error_message = ($jasa['status'] == 'menunggu') ? 'Akun Anda menunggu konfirmasi.' : 'Akun Anda tidak aktif.';
                    header("location: login.php?error=" . urlencode($error_message));
                    exit;
                }
            }
        }
    }
    header("location: login.php?error=" . urlencode('Username atau Password Salah!'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mitra Jasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background-color: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); text-align: center; width: 100%; max-width: 400px; }
        .login-box .logo { max-width: 100px; margin-bottom: 20px; }
        .login-box h2 { margin-bottom: 20px; color: #1F2937; font-weight: 600; }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="../assets/img/logo_kitapaketin_aksen_segar.png" alt="Logo Aplikasi" class="logo">
        
        <?php if (isset($_SESSION['jasa_id'])): ?>
            <h2 class="h4">Anda Sudah Login</h2>
            <div class="alert alert-info">
                Saat ini Anda login sebagai Mitra <strong><?php echo htmlspecialchars($_SESSION['nama_js']); ?></strong>.
            </div>
            <a href="index.php" class="btn btn-primary w-100 mb-2">Lanjutkan ke Dasbor Mitra</a>
            <a href="../logout.php?role=mitra" class="btn btn-outline-secondary btn-sm w-100">Logout untuk ganti akun</a>
        
        <?php else: ?>
            <h2>Login Mitra Jasa</h2>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group text-start mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group text-start mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">LOGIN</button>
            </form>
            <div class="text-center mt-3"><small>Belum punya akun? <a href="register_jasa.php">Daftar di sini</a></small></div>
            <div class="text-center mt-2"><small><a href="../login.php">« Kembali ke pilihan login</a></small></div>
        <?php endif; ?>

    </div>
</body>
</html>