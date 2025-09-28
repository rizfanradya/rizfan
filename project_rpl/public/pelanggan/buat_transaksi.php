<?php
// Atur judul halaman
$page_title = "Buat Transaksi";

// [ATURAN UTAMA] Panggil header SEBAGAI BARIS PERTAMA.
include '../../includes/templates/header_pelanggan.php';

// Baru panggil koneksi dan logika lainnya.
include '../../includes/koneksi.php';

// Validasi & ambil data jasa dari URL
if (!isset($_GET['jasa_id']) || !is_numeric($_GET['jasa_id'])) {
    header('Location: index.php');
    exit;
}
$jasa_id = $_GET['jasa_id'];
$user_id = $_SESSION['user_id'];

// Ambil data user yang login untuk auto-fill form
$query_user = "SELECT nama_lengkap, no_telepon FROM users WHERE id_user = ?";
$stmt_user = mysqli_prepare($koneksi, $query_user);
mysqli_stmt_bind_param($stmt_user, "i", $user_id);
mysqli_stmt_execute($stmt_user);
$result_user = mysqli_stmt_get_result($stmt_user);
$user_data = mysqli_fetch_assoc($result_user);

// Ambil detail nama jasa yang dipilih
$query_jasa = "SELECT nama_js FROM nama_js WHERE id_js = ? AND status = 'aktif'";
$stmt_jasa = mysqli_prepare($koneksi, $query_jasa);
mysqli_stmt_bind_param($stmt_jasa, "i", $jasa_id);
mysqli_stmt_execute($stmt_jasa);
$result_jasa = mysqli_stmt_get_result($stmt_jasa);
$jasa = mysqli_fetch_assoc($result_jasa);
if (!$jasa) { die("Jasa pengiriman tidak ditemukan."); }
$nama_jasa_terpilih = $jasa['nama_js'];

// Ambil daftar layanan yang ditawarkan
$layanan_options = [];
$query_layanan = "SELECT layanan_id, nama_layanan, harga, jarak_min, jarak_max FROM jenis_layanan WHERE jasa_id = ? AND status_layanan = 'Aktif'";
$stmt_layanan = mysqli_prepare($koneksi, $query_layanan);
mysqli_stmt_bind_param($stmt_layanan, "i", $jasa_id);
mysqli_stmt_execute($stmt_layanan);
$result_layanan = mysqli_stmt_get_result($stmt_layanan);
while ($row = mysqli_fetch_assoc($result_layanan)) {
    $layanan_options[] = $row;
}
?>

<div class="card form-container" style="max-width: 700px; margin: auto;">
    <div class="card-body p-4">
        <h1 class="card-title h4 text-center mb-4">Formulir Pengiriman</h1>
        
        <?php if(isset($_GET['error']) && $_GET['error'] == 'jarak'): ?>
            <div class="alert alert-danger">
                Gagal membuat pesanan. Jarak yang Anda masukkan tidak sesuai dengan batasan layanan yang dipilih.
            </div>
        <?php endif; ?>

        <div class="alert alert-info small">Anda sedang memesan dari: <strong><?php echo htmlspecialchars($nama_jasa_terpilih); ?></strong></div>

        <form action="proses_transaksi.php" method="POST">
            <input type="hidden" name="id_js" value="<?php echo $jasa_id; ?>">
            
            <div class="mb-3">
                <label for="id_layanan" class="form-label">Pilih Jenis Layanan</label>
                <select id="id_layanan" name="id_layanan" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Layanan --</option>
                    <?php foreach ($layanan_options as $layanan): ?>
                        <option value="<?php echo $layanan['layanan_id']; ?>" 
                                data-harga="<?php echo $layanan['harga']; ?>"
                                data-jarak-min="<?php echo $layanan['jarak_min']; ?>"
                                data-jarak-max="<?php echo $layanan['jarak_max']; ?>">
                            <?php echo htmlspecialchars($layanan['nama_layanan']) . ' (' . htmlspecialchars($layanan['jarak_min']) . ' - ' . htmlspecialchars($layanan['jarak_max']) . ' km) - Rp ' . number_format($layanan['harga']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                    <input type="text" id="nama_pengirim" name="nama_pengirim" class="form-control" value="<?php echo htmlspecialchars($user_data['nama_lengkap']); ?>" readonly required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomor_pengirim" class="form-label">Nomor Pengirim</label>
                    <input type="text" id="nomor_pengirim" name="nomor_pengirim" class="form-control" value="<?php echo htmlspecialchars($user_data['no_telepon']); ?>" readonly required>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat_penjemputan" class="form-label">Alamat Penjemputan</label>
                <textarea id="alamat_penjemputan" name="alamat_penjemputan" class="form-control" rows="3" required></textarea>
            </div>
            
            <hr class="my-4">

            <div class="row">
                 <div class="col-md-6 mb-3">
                    <label for="nama_penerima" class="form-label">Nama Penerima</label>
                    <input type="text" id="nama_penerima" name="nama_penerima" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomor_penerima" class="form-label">Nomor Penerima</label>
                    <input type="text" id="nomor_penerima" name="nomor_penerima" class="form-control" placeholder="Nomor telepon penerima" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                <textarea id="alamat_tujuan" name="alamat_tujuan" class="form-control" rows="3" required></textarea>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jarak_km" class="form-label">Jarak (km)</label>
                    <input type="number" step="0.1" name="jarak_km" id="jarak_km" class="form-control" placeholder="Pilih layanan dahulu" required disabled>
                    <div id="jarak_helper" class="form-text"></div>
                </div>
                 <div class="col-md-6 mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="text" name="total_harga" id="total_harga" class="form-control" readonly style="background-color: #e9ecef; font-weight: bold;">
                </div>
            </div>
            
            <button type="submit" class="btn btn-success w-100 btn-lg mt-3">Kirim Pesanan</button>
        </form>
        <a href="index.php" class="btn btn-link w-100 mt-2">« Batal dan Kembali</a>
    </div>
</div>

<script>
    // Kode Javascript tidak perlu diubah
    const layananSelect = document.getElementById('id_layanan');
    const jarakInput = document.getElementById('jarak_km');
    const totalHargaInput = document.getElementById('total_harga');
    const jarakHelper = document.getElementById('jarak_helper');

    function handleLayananChange() {
        const selectedOption = layananSelect.options[layananSelect.selectedIndex];
        const jarakMin = selectedOption.getAttribute('data-jarak-min');
        const jarakMax = selectedOption.getAttribute('data-jarak-max');
        jarakInput.value = '';
        if (jarakMin && jarakMax) {
            jarakInput.min = jarakMin;
            jarakInput.max = jarakMax;
            jarakInput.placeholder = `Jarak ${jarakMin} - ${jarakMax} km`;
            jarakHelper.textContent = `Jarak untuk layanan ini: ${jarakMin} km s/d ${jarakMax} km.`;
            jarakInput.disabled = false;
        } else {
            jarakInput.placeholder = 'Pilih layanan dahulu';
            jarakHelper.textContent = '';
            jarakInput.disabled = true;
        }
        updateTotalHarga();
    }
    function updateTotalHarga() {
        const selectedOption = layananSelect.options[layananSelect.selectedIndex];
        const hargaLayanan = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        const jarak = parseFloat(jarakInput.value) || 0;
        if (hargaLayanan > 0 && jarak > 0) {
            const total = hargaLayanan * jarak;
            totalHargaInput.value = 'Rp ' + total.toLocaleString('id-ID');
        } else {
            totalHargaInput.value = '';
        }
    }
    layananSelect.addEventListener('change', handleLayananChange);
    jarakInput.addEventListener('input', updateTotalHarga);
</script>

<?php
include '../../includes/templates/footer.php';
?>