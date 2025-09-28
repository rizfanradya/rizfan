<?php
// Atur judul halaman
$page_title = "Edit Layanan";

// [ATURAN UTAMA] Panggil header SEBAGAI BARIS PERTAMA.
include '../../includes/templates/header_mitra.php';

// Baru panggil koneksi dan logika lainnya
include '../../includes/koneksi.php';

$jasa_id = $_SESSION['jasa_id'];

// Validasi ID layanan dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$layanan_id = $_GET['id'];

// Ambil data layanan yang akan diedit dari database
$query = "SELECT * FROM jenis_layanan WHERE layanan_id = ? AND jasa_id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ii", $layanan_id, $jasa_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$layanan = mysqli_fetch_assoc($result);

// Jika layanan tidak ditemukan atau bukan milik mitra ini, kembalikan ke dasbor
if (!$layanan) {
    header('Location: index.php?error=notfound');
    exit;
}
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title h5 mb-0">Edit Layanan: <?php echo htmlspecialchars($layanan['nama_layanan']); ?></h2>
    </div>
    <div class="card-body">
        <form action="proses_edit_layanan.php" method="POST">
            <input type="hidden" name="layanan_id" value="<?php echo $layanan['layanan_id']; ?>">
            
            <div class="mb-3">
                <label for="nama_layanan" class="form-label">Nama Layanan:</label>
                <input type="text" id="nama_layanan" name="nama_layanan" class="form-control" value="<?php echo htmlspecialchars($layanan['nama_layanan']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Singkat (Opsional):</label>
                <textarea id="deskripsi" name="deskripsi" rows="2" class="form-control"><?php echo htmlspecialchars($layanan['deskripsi']); ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="estimasi_waktu" class="form-label">Estimasi Waktu:</label>
                    <input type="text" id="estimasi_waktu" name="estimasi_waktu" class="form-control" value="<?php echo htmlspecialchars($layanan['estimasi_waktu']); ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="harga" class="form-label">Harga (per km):</label>
                    <input type="number" id="harga" name="harga" class="form-control" value="<?php echo htmlspecialchars($layanan['harga']); ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="jarak_max" class="form-label">Jarak Maksimal (km):</label>
                    <input type="number" id="jarak_max" name="jarak_max" step="0.1" class="form-control" value="<?php echo htmlspecialchars($layanan['jarak_max']); ?>" required>
                </div>
            </div>
            <input type="hidden" name="jarak_min" value="<?php echo htmlspecialchars($layanan['jarak_min']); ?>">
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php 
// Panggil footer di bagian akhir.
include '../../includes/templates/footer.php'; 
?>