<?php
session_start();

// Jika sudah login sebagai developer, langsung ke dashboard-nya
if (isset($_SESSION['developer_logged_in']) && $_SESSION['developer_logged_in'] === true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Developer Access</title>
    <style>
        body { font-family: sans-serif; background-color: #2c3e50; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); width: 350px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        input[type="submit"] { width: 100%; padding: 12px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .error-msg { background: #e74c3c; color: white; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Developer Access</h1>
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="error-msg">Kode Rahasia Salah!</div>';
        }
        ?>
        <form action="proses_login_developer.php" method="POST">
            <div class="form-group">
                <label for="secret_code">Kode Rahasia:</label>
                <input type="password" id="secret_code" name="secret_code" required>
            </div>
            <input type="submit" value="LOGIN">
        </form>
    </div>
</body>
</html>