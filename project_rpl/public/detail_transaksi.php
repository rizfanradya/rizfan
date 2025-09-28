<?php
session_start();
include 'koneksi.php'; // koneksi di root

// Keamanan: Cek apakah ada yang login (pelanggan atau mitra)
if (!isset($_SESSION['user_id']) && !isset($_SESSION['jasa_id'])) {
    header('Location: login.php');
    exit;
}

// Validasi ID transaksi dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Akses tidak valid.");
}
$id_transaksi = $_GET['id'];

// Query untuk mengambil semua detail transaksi
$query = "
    SELECT 
        t.*, 
        u.nama_lengkap as nama_pelanggan, 
        js.nama_js, 
        jl.nama_layanan, jl.estimasi_waktu
    FROM 
        transaksi t
    JOIN 
        users u ON t.id_user = u.user_id
    JOIN 
        nama_js js ON t.id_js = js.id_js
    JOIN 
        jenis_layanan jl ON t.id_layanan = jl.layanan_id
    WHERE 
        t.id_transaksi = ?
";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$transaksi = mysqli_fetch_assoc($result);

// Jika transaksi tidak ditemukan, hentikan
if (!$transaksi) {
    die("Transaksi tidak ditemukan.");
}

// Keamanan Tambahan: Pastikan yang mengakses adalah pemilik transaksi atau mitra yang bersangkutan
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $transaksi['id_user']) {
    die("Anda tidak memiliki hak akses untuk melihat detail transaksi ini.");
}
if (isset($_SESSION['jasa_id']) && $_SESSION['jasa_id'] != $transaksi['id_js']) {
    die("Anda tidak memiliki hak akses untuk melihat detail transaksi ini.");
}

// Logika untuk linimasa status
$statuses = ['Diproses', 'Dijemput', 'Dikirim', 'Selesai'];
$current_status_index = array_search($transaksi['status'], $statuses);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #<?php echo $id_transaksi; ?></title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background-color: #f4f7f6; color: #333; margin: 0; padding: 20px;}
        .container { max-width: 800px; margin: 0 auto; }
        .card { background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; padding: 25px; }
        h1, h2 { color: #34495e; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .summary-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
        .summary-item { padding: 15px; background-color: #f9f9f9; border-radius: 5px; }
        .summary-item label { display: block; font-size: 0.9em; color: #7f8c8d; margin-bottom: 5px; }
        .summary-item span { font-size: 1.1em; font-weight: bold; }
        .timeline { list-style: none; padding: 0; }
        .timeline-item { position: relative; padding-bottom: 20px; padding-left: 30px; border-left: 2px solid #ddd; }
        .timeline-item::before { content: ''; width: 12px; height: 12px; background: #ddd; border-radius: 50%; position: absolute; left: -7px; top: 5px; }
        .timeline-item.completed { border-left-color: #2ecc71; }
        .timeline-item.completed::before { background: #2ecc71; }
        .timeline-item.current { border-left-color: #2ecc71; }
        .timeline-item.current::before { background: #3498db; border: 2px solid white; box-shadow: 0 0 0 3px #3498db; }
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .detail-item p { margin: 5px 0; }
        .back-link { display: inline-block; margin-top: 20px; }
        /* Warna Status */
        .status-Diproses, .status-0 { color: #f39c12; } .status-Dijemput { color: #8e44ad; }
        .status-Dikirim { color: #3498db; } .status-Selesai { color: #2ecc71; } .status-Dibatalkan { color: #e74c3c; }
    </style>
</head>
<body>
<div class="container">
    <h1>Detail Transaksi</h1>
    <div class="card">
        <h2>Ringkasan</h2>
        <div class="summary-grid">
            <div class="summary-item">
                <label>Kode Resi</label>
                <span>#<?php echo htmlspecialchars($transaksi['id_transaksi']); ?></span>
            </div>
            <div class="summary-item">
                <label>Status Saat Ini</label>
                <span class="status-<?php echo str_replace(' ', '', $transaksi['status']); ?>"><?php echo htmlspecialchars($transaksi['status']); ?></span>
            </div>
            <div class="summary-item">
                <label>Jasa Pengiriman</label>
                <span><?php echo htmlspecialchars($transaksi['nama_js']); ?></span>
            </div>
        </div>
    </div>

    <div class="card">
        <h2>Linimasa Pengiriman</h2>
        <ul class="timeline">
            <?php foreach ($statuses as $index => $status): ?>
                <?php
                    $class = '';
                    if ($transaksi['status'] == 'Dibatalkan') {
                        $class = ''; // Jika dibatalkan, jangan tandai apapun
                    } elseif ($index < $current_status_index) {
                        $class = 'completed'; // Status yang sudah terlewati
                    } elseif ($index == $current_status_index) {
                        $class = 'current'; // Status saat ini
                    }
                ?>
                <li class="timeline-item <?php echo $class; ?>">
                    <strong><?php echo $status; ?></strong>
                    <?php if($index == 0 && $class != ''): ?> <small>- <?php echo date('d M Y, H:i', strtotime($transaksi['tanggal_transaksi'])); ?></small> <?php endif; ?>
                </li>
            <?php endforeach; ?>
             <?php if($transaksi['status'] == 'Dibatalkan'): ?>
                <li class="timeline-item"> <strong style="color: #e74c3c;">Dibatalkan</strong> </li>
             <?php endif; ?>
        </ul>
    </div>
    
    <div class="card">
        <h2>Detail Pengiriman</h2>
        <div class="detail-grid">
            <div class="detail-item">
                <h3>Pengirim</h3>
                <p><strong><?php echo htmlspecialchars($transaksi['nama_pengirim']); ?></strong></p>
                <p><?php echo htmlspecialchars($transaksi['alamat_penjemputan']); ?></p>
            </div>
            <div class="detail-item">
                <h3>Penerima</h3>
                <p><strong><?php echo htmlspecialchars($transaksi['nama_penerima']); ?></strong></p>
                <p><?php echo htmlspecialchars($transaksi['alamat_tujuan']); ?></p>
            </div>
        </div>
    </div>

    <div class="card">
        <h2>Informasi Layanan & Biaya</h2>
        <div class="detail-grid">
            <div class="detail-item">
                <p><strong>Layanan:</strong> <?php echo htmlspecialchars($transaksi['nama_layanan']); ?></p>
                <p><strong>Estimasi:</strong> <?php echo htmlspecialchars($transaksi['estimasi_waktu']); ?></p>
            </div>
             <div class="detail-item">
                <p><strong>Jarak:</strong> <?php echo htmlspecialchars($transaksi['jarak_km']); ?> km</p>
                <p><strong>Total Biaya:</strong> Rp <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?></p>
            </div>
        </div>
    </div>
    
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="user/dashboard_pelanggan.php" class="back-link">« Kembali ke Dasbor</a>
    <?php elseif(isset($_SESSION['jasa_id'])): ?>
         <a href="mitra/index.php" class="back-link">« Kembali ke Dasbor</a>
    <?php endif; ?>
</div>
</body>
</html>