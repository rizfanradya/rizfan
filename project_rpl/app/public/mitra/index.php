<?php
// Atur variabel unik untuk halaman ini, yang akan digunakan oleh header.
$page_title = 'Dasbor Mitra';

// [ATURAN UTAMA] Panggil header SEBAGAI BARIS PERTAMA.
include '../../includes/templates/header_mitra.php';

// Setelah header dipanggil, baru aman untuk memanggil koneksi dan menggunakan variabel sesi.
include '../../includes/koneksi.php';

$jasa_id = $_SESSION['jasa_id'];
$nama_jasa = $_SESSION['nama_js'];

// Logika untuk menambah layanan baru (tidak berubah)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_layanan'])) {
    $nama_layanan = $_POST['nama_layanan'];
    $deskripsi = $_POST['deskripsi'];
    $estimasi = $_POST['estimasi_waktu'];
    $harga = $_POST['harga'];
    $jarak_min = $_POST['jarak_min'];
    $jarak_max = $_POST['jarak_max'];
    if (!empty($nama_layanan) && !empty($estimasi) && !empty($harga) && !empty($jarak_min) && !empty($jarak_max)) {
        $query = "INSERT INTO jenis_layanan (jasa_id, nama_layanan, deskripsi, estimasi_waktu, harga, jarak_min, jarak_max, status_layanan) VALUES (?, ?, ?, ?, ?, ?, ?, 'Aktif')";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "isssddd", $jasa_id, $nama_layanan, $deskripsi, $estimasi, $harga, $jarak_min, $jarak_max);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?tambah=sukses');
            exit;
        }
    }
    header('Location: index.php?tambah=gagal');
    exit;
}

// Mengambil daftar layanan (tidak berubah)
$layanan_list = [];
$query_layanan = "SELECT layanan_id, nama_layanan, deskripsi, estimasi_waktu, harga, jarak_min, jarak_max, status_layanan FROM jenis_layanan WHERE jasa_id = ?";
$stmt_layanan = mysqli_prepare($koneksi, $query_layanan);
mysqli_stmt_bind_param($stmt_layanan, "i", $jasa_id);
mysqli_stmt_execute($stmt_layanan);
$result_layanan = mysqli_stmt_get_result($stmt_layanan);
while ($row = mysqli_fetch_assoc($result_layanan)) { $layanan_list[] = $row; }

// Mengambil daftar transaksi (tidak berubah)
$transaksi_list = [];
$query_transaksi = "SELECT t.id_transaksi, jl.nama_layanan, t.nama_pengirim, t.alamat_penjemputan, t.nama_penerima, t.alamat_tujuan, t.total_harga, t.status, t.tanggal_transaksi FROM transaksi t JOIN jenis_layanan jl ON t.id_layanan = jl.layanan_id WHERE t.id_js = ? ORDER BY t.tanggal_transaksi DESC";
$stmt_transaksi = mysqli_prepare($koneksi, $query_transaksi);
mysqli_stmt_bind_param($stmt_transaksi, "i", $jasa_id);
mysqli_stmt_execute($stmt_transaksi);
$result_transaksi = mysqli_stmt_get_result($stmt_transaksi);
while ($row = mysqli_fetch_assoc($result_transaksi)) { $transaksi_list[] = $row; }
?>

<?php if(isset($_GET['status_layanan_ubah']) && $_GET['status_layanan_ubah'] == 'sukses'): ?>
    <div class="alert alert-success">Status layanan berhasil diubah!</div>
<?php endif; ?>

<?php if(isset($_GET['tambah']) && $_GET['tambah'] == 'sukses'): ?>
    <div class="alert alert-success">Layanan baru berhasil ditambahkan!</div>
<?php endif; ?>
<?php if(isset($_GET['edit']) && $_GET['edit'] == 'sukses'): ?>
    <div class="alert alert-success">Layanan berhasil diperbarui!</div>
<?php endif; ?>
<?php if(isset($_GET['update']) && $_GET['update'] == 'sukses'): ?>
    <div class="alert alert-success">Status transaksi berhasil diperbarui!</div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="h5 mb-0">Manajemen Layanan</h2>
        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formTambahLayanan">
            + Tambah Baru
        </button>
    </div>
    <div class="collapse" id="formTambahLayanan">
        <div class="card-body border-bottom">
            <form action="index.php" method="POST">
                <div class="mb-3"><label for="nama_layanan" class="form-label">Nama Layanan:</label><input type="text" id="nama_layanan" name="nama_layanan" class="form-control" required></div>
                <div class="mb-3"><label for="deskripsi" class="form-label">Deskripsi Singkat:</label><textarea id="deskripsi" name="deskripsi" rows="2" class="form-control"></textarea></div>
                <div class="row">
                    <div class="col-md-4 mb-3"><label for="estimasi_waktu" class="form-label">Estimasi Waktu:</label><input type="text" id="estimasi_waktu" name="estimasi_waktu" class="form-control" placeholder="Contoh: 1-2 Hari" required></div>
                    <div class="col-md-4 mb-3"><label for="harga" class="form-label">Harga (per km):</label><input type="number" id="harga" name="harga" class="form-control" required></div>
                    <div class="col-md-4 mb-3"><label for="jarak_max" class="form-label">Jarak Maksimal (km):</label><input type="number" id="jarak_max" name="jarak_max" step="0.1" class="form-control" required></div>
                </div>
                <input type="hidden" name="jarak_min" value="1"><button type="submit" name="tambah_layanan" class="btn btn-primary">Simpan Layanan</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <h3 class="h6">Daftar Layanan Anda</h3>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>Nama Layanan</th><th>Harga</th><th>Batasan Jarak</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    <?php if (empty($layanan_list)): ?>
                        <tr><td colspan="5" class="text-center text-muted">Anda belum menambahkan layanan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($layanan_list as $layanan): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($layanan['nama_layanan']); ?><br><small class="text-muted"><?php echo htmlspecialchars($layanan['deskripsi']); ?></small></td>
                                <td>Rp <?php echo number_format($layanan['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($layanan['jarak_min']); ?> - <?php echo htmlspecialchars($layanan['jarak_max']); ?> km</td>
                                <td><span class="badge bg-<?php echo ($layanan['status_layanan'] == 'Aktif') ? 'success' : 'danger'; ?>"><?php echo $layanan['status_layanan']; ?></span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class="btn btn-secondary btn-sm" href="edit_layanan.php?id=<?php echo $layanan['layanan_id']; ?>">Edit</a>
                                        
                                        <form action="hapus_layanan.php" method="POST" onsubmit="return confirm('Anda yakin ingin mengubah status layanan ini?');" class="d-inline">
                                            <input type="hidden" name="layanan_id" value="<?php echo $layanan['layanan_id']; ?>">
                                            <?php if ($layanan['status_layanan'] == 'Aktif'): ?>
                                                <input type="hidden" name="aksi" value="nonaktifkan">
                                                <button type="submit" class="btn btn-warning btn-sm">Nonaktifkan</button>
                                            <?php else: ?>
                                                <input type="hidden" name="aksi" value="aktifkan">
                                                <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<h2 class="h5 mb-3">Riwayat Transaksi Masuk</h2>
<?php if (empty($transaksi_list)): ?>
    <div class="card"><div class="card-body text-center text-muted">Belum ada transaksi yang masuk.</div></div>
<?php else: ?>
    <?php foreach ($transaksi_list as $transaksi): ?>
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center bg-light">
                <span class="fw-bold text-dark"><?php echo htmlspecialchars($transaksi['nama_layanan']); ?></span>
                <?php
                    $status_class = 'secondary';
                    if($transaksi['status'] == 'Diproses') $status_class = 'warning text-dark';
                    if($transaksi['status'] == 'Dijemput') $status_class = 'info text-dark';
                    if($transaksi['status'] == 'Dikirim') $status_class = 'primary';
                    if($transaksi['status'] == 'Selesai') $status_class = 'success';
                    if($transaksi['status'] == 'Dibatalkan') $status_class = 'danger';
                ?>
                <span class="badge bg-<?php echo $status_class; ?>"><?php echo htmlspecialchars($transaksi['status']); ?></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h6 class="card-title small text-muted">Info Pengirim & Penerima</h6>
                        <strong>Pengirim:</strong> <?php echo htmlspecialchars($transaksi['nama_pengirim']); ?><br>
                        <strong>Penerima:</strong> <?php echo htmlspecialchars($transaksi['nama_penerima']); ?>
                    </div>
                    <div class="col-md-6">
                        <h6 class="card-title small text-muted">Detail Pesanan</h6>
                        <strong>Tanggal:</strong> <?php echo date('d M Y, H:i', strtotime($transaksi['tanggal_transaksi'])); ?><br>
                        <strong>Total Harga:</strong> <span class="fw-bold text-success">Rp <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?></span><br><br>
                        <strong>Alamat Penjemputan:</strong><br>
                        <small><?php echo htmlspecialchars($transaksi['alamat_penjemputan']); ?></small><br>
                        <strong class="mt-2 d-block">Alamat Penerima:</strong>
                        <small><?php echo htmlspecialchars($transaksi['alamat_tujuan']); ?></small>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <form action="update_status.php" method="POST">
                    <input type="hidden" name="id_transaksi" value="<?php echo $transaksi['id_transaksi']; ?>">
                    <div class="input-group">
                        <select name="status_baru" class="form-select">
                            <option value="Diproses" <?php if($transaksi['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                            <option value="Dijemput" <?php if($transaksi['status'] == 'Dijemput') echo 'selected'; ?>>Dijemput</option>
                            <option value="Dikirim" <?php if($transaksi['status'] == 'Dikirim') echo 'selected'; ?>>Dikirim</option>
                            <option value="Selesai" <?php if($transaksi['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                            <option value="Dibatalkan" <?php if($transaksi['status'] == 'Dibatalkan') echo 'selected'; ?>>Dibatalkan</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php
// Panggil footer di bagian paling akhir.
include '../../includes/templates/footer.php';
?>