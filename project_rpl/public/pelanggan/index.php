<?php
// Atur variabel unik untuk halaman ini, yang akan digunakan oleh header.
$page_title = 'Pesan Sekarang';

// [ATURAN UTAMA] Panggil header SEBAGAI BARIS PERTAMA.
// Header akan menangani sesi, login check, dan semua HTML bagian atas.
include '../../includes/templates/header_pelanggan.php';

// Setelah header dipanggil, baru aman untuk memanggil koneksi dan menggunakan variabel sesi.
include '../../includes/koneksi.php';

// Logika PHP spesifik untuk halaman ini.
// Kita bisa langsung pakai $_SESSION['user_id'] karena header sudah memastikannya ada.
$user_id = $_SESSION['user_id'];

// Logika untuk filter dan urutkan
$cari_nama = $_GET['cari_nama'] ?? '';
$urutkan = $_GET['urutkan'] ?? 'rating_desc';
$jasa_list = [];
$params = [];
$types = '';
$query_jasa = "SELECT js.id_js, js.nama_js, js.alamat, js.cabang, AVG(u.rating) as rata_rating, COUNT(u.id_ulasan) as jumlah_ulasan FROM nama_js js LEFT JOIN ulasan u ON js.id_js = u.id_js WHERE js.status = 'aktif' AND js.id_js IN (SELECT jasa_id FROM jenis_layanan WHERE status_layanan = 'Aktif')";
if (!empty($cari_nama)) {
    $query_jasa .= " AND js.nama_js LIKE ?";
    $params[] = "%" . $cari_nama . "%";
    $types .= 's';
}
$query_jasa .= " GROUP BY js.id_js";
switch ($urutkan) {
    case 'nama_asc':
        $query_jasa .= " ORDER BY js.nama_js ASC";
        break;
    default:
        $query_jasa .= " ORDER BY rata_rating DESC, jumlah_ulasan DESC";
        break;
}
$stmt_jasa = mysqli_prepare($koneksi, $query_jasa);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt_jasa, $types, ...$params);
}
mysqli_stmt_execute($stmt_jasa);
$result_jasa = mysqli_stmt_get_result($stmt_jasa);
if ($result_jasa) {
    while ($row = mysqli_fetch_assoc($result_jasa)) {
        $jasa_list[] = $row;
    }
}
?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'transaksi_sukses') : ?>
    <div class="alert alert-success">Transaksi Anda berhasil dibuat! Cek statusnya di halaman <a href="riwayat.php" class="alert-link">Riwayat Pesanan</a>.</div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-body p-4">
        <form action="index.php" method="GET" class="row g-3 align-items-end">
            <div class="col-md-6"><label for="cari_nama" class="form-label">Cari Nama Jasa</label><input type="text" name="cari_nama" id="cari_nama" class="form-control" value="<?php echo htmlspecialchars($cari_nama); ?>" placeholder="Contoh: Cepat Express"></div>
            <div class="col-md-4"><label for="urutkan" class="form-label">Urutkan Berdasarkan</label><select name="urutkan" id="urutkan" class="form-select">
                    <option value="rating_desc" <?php if ($urutkan == 'rating_desc') echo 'selected'; ?>>Rating Tertinggi</option>
                    <option value="nama_asc" <?php if ($urutkan == 'nama_asc') echo 'selected'; ?>>Nama A-Z</option>
                </select></div>
            <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Cari</button></div>
        </form>
    </div>
</div>

<div class="row g-4">
    <?php if (empty($jasa_list)) : ?>
        <div class="col-12">
            <div class="alert alert-warning text-center">Tidak ada jasa pengiriman yang cocok.</div>
        </div>
    <?php else : ?>
        <?php foreach ($jasa_list as $jasa) : ?>
            <div class="col-lg-4 col-md-6">
                <div class="jasa-card h-100 d-flex flex-column">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-primary"><?php echo htmlspecialchars($jasa['nama_js']); ?></h5>
                        <div class="rating-bintang mb-2">
                            <?php if ($jasa['rata_rating']) : ?>
                                <i class="bi bi-star-fill"></i><strong><?php echo number_format($jasa['rata_rating'], 1); ?></strong> <small class="text-muted">(<?php echo $jasa['jumlah_ulasan']; ?> ulasan)</small>
                            <?php else : ?><small class="text-muted">Belum ada ulasan</small><?php endif; ?>
                        </div>
                        <p class="card-text text-muted mb-1"><i class="bi bi-geo-alt-fill me-2"></i><?php echo htmlspecialchars($jasa['cabang']); ?></p>
                        <p class="card-text text-muted"><small><?php echo htmlspecialchars($jasa['alamat']); ?></small></p>
                    </div>
                    <div class="card-footer bg-light border-0 p-3">
                        <a href="buat_transaksi.php?jasa_id=<?php echo $jasa['id_js']; ?>" class="btn btn-success w-100 fw-bold">Pilih & Buat Pesanan</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php
// Panggil footer di bagian paling akhir untuk menutup tag HTML dan memuat JS.
include '../../includes/templates/footer.php';
?>