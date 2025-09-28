<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background-color: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center; width: 350px; }
        .logo { max-width: 100px; margin-bottom: 20px; } /* Style untuk logo */
        .login-container h1 { margin-bottom: 30px; color: #333; }
        .login-container p { margin-bottom: 20px; font-size: 1.1em; color: #555; }
        .btn { display: block; width: 100%; padding: 12px; margin-bottom: 15px; border: none; border-radius: 5px; color: white; font-size: 1em; text-decoration: none; cursor: pointer; }
        .btn-jasa { background-color: #007bff; }
        .btn-pelanggan { background-color: #28a745; }
        .btn-developer { background-color: #34495e; } 
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>

    <div class="login-container">
        <img src="assets/img/logo_kitapaketin_aksen_segar.png" alt="Logo Perusahaan" class="logo">
        
        <h1>Login Sistem</h1>
        <p>Silakan pilih jenis akun Anda:</p>
        
        <a href="mitra/login.php" class="btn btn-jasa">Login sebagai Jasa Antar</a>
        <a href="pelanggan/login.php" class="btn btn-pelanggan">Login sebagai Pelanggan</a>
        <a href="developer/login.php" class="btn btn-developer">Login sebagai Developer</a>
    </div>

</body>
</html>