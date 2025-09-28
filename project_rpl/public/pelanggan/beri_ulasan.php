<?php

include '../../includes/templates/header_pelanggan.php';

include '../../includes/koneksi.php';

// Autentikasi dan validasi
if (!isset($_SESSION['user_id'])) { header('Location: login_pelanggan.php'); exit; }
if (!isset($_GET['id_transaksi']) || !is_numeric($_GET['id_transaksi'])) { die("Akses tidak valid."); }

$id_transaksi = $_GET['id_transaksi'];
$id_user_session = $_SESSION['user_id'];

// Ambil detail transaksi untuk memastikan pengguna adalah pemiliknya dan untuk mendapatkan id_js
$query = "SELECT id_transaksi, id_user, id_js FROM transaksi WHERE id_transaksi = ? AND id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ii", $id_transaksi, $id_user_session);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$transaksi = mysqli_fetch_assoc($result);

// Jika transaksi tidak ditemukan atau bukan milik user, hentikan
if (!$transaksi) {
    die("Transaksi tidak ditemukan atau Anda tidak memiliki hak untuk memberikan ulasan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan</title>
    <style>
        /* PERBAIKAN CSS DIMULAI DI SINI */
        body { 
            font-family: sans-serif; 
            background-color: #f0f2f5; 
            /* Hapus properti Flexbox dari body agar header berada di atas */
            padding: 0; 
            margin: 0;
        }

        /* Container baru untuk menengahkan formulir di bawah header */
        .ulasan-wrapper {
            display: flex;
            justify-content: center; /* Posisikan form di tengah secara horizontal */
            padding: 40px 20px; /* Jarak antara header dan form */
            width: 100%;
            box-sizing: border-box;
        }
        
        .form-container { 
            background-color: #fff; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); 
            width: 100%; 
            max-width: 500px; 
        }
        /* PERBAIKAN CSS SELESAI DI SINI */
        
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 10px; font-weight: bold; }
        textarea { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 16px; resize: vertical; }
        button { width: 100%; padding: 15px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .rating { display: flex; flex-direction: row-reverse; justify-content: center; }
        .rating > input{ display:none; }
        .rating > label { position: relative; width: 1.1em; font-size: 2.5rem; color: #FFD600; cursor: pointer; }
        .rating > label::before{ content: "\2605"; position: absolute; opacity: 0; transition: opacity 0.2s; }
        .rating > label:hover:before, .rating > label:hover ~ label:before { opacity: 1 !important; }
        .rating > input:checked ~ label:before{ opacity:1; }
    </style>
</head>
<body>
    <div class="ulasan-wrapper">
        <div class="form-container">
            <h1>Beri Ulasan untuk Transaksi #<?php echo htmlspecialchars($id_transaksi); ?></h1>
            <form action="proses_ulasan.php" method="POST">
                
                <input type="hidden" name="id_transaksi" value="<?php echo htmlspecialchars($transaksi['id_transaksi']); ?>">
                <input type="hidden" name="id_js" value="<?php echo htmlspecialchars($transaksi['id_js']); ?>">

                <div class="form-group">
                    <label>Rating Anda:</label>
                    <div class="rating">
                        <input type="radio" name="rating" value="5" id="5" required><label for="5">☆</label>
                        <input type="radio" name="rating" value="4" id="4" required><label for="4">☆</label>
                        <input type="radio" name="rating" value="3" id="3" required><label for="3">☆</label>
                        <input type="radio" name="rating" value="2" id="2" required><label for="2">☆</label>
                        <input type="radio" name="rating" value="1" id="1" required><label for="1">☆</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="komentar">Komentar (Opsional):</label>
                    <textarea name="komentar" id="komentar" rows="4"></textarea>
                </div>
                <button type="submit">Kirim Ulasan</button>
            </form>
        </div>
    </div>
    </body>
</html>