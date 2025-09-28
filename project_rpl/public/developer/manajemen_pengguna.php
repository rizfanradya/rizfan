<?php
// Atur judul halaman
$page_title = "Manajemen Pengguna";

// [ATURAN UTAMA] Panggil header SEBAGAI BARIS PERTAMA.
include '../../includes/templates/header_developer.php';

// Baru panggil koneksi dan logika lainnya
include '../../includes/koneksi.php';

// Ambil semua data pelanggan
$pelanggan_list = [];
$query_pelanggan = "SELECT id_user, nama_lengkap, email, tanggal_registrasi, status FROM users ORDER BY tanggal_registrasi DESC";
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
while ($row = mysqli_fetch_assoc($result_pelanggan)) { $pelanggan_list[] = $row; }

// Ambil semua data mitra jasa
$mitra_list = [];
$query_mitra = "SELECT id_js, nama_js, penanggung_jawab, email, tanggal_terdaftar, status FROM nama_js ORDER BY tanggal_terdaftar DESC";
$result_mitra = mysqli_query($koneksi, $query_mitra);
while ($row = mysqli_fetch_assoc($result_mitra)) { $mitra_list[] = $row; }
?>

<?php if(isset($_GET['ubah_status']) && $_GET['ubah_status'] == 'sukses'): ?>
    <div class="alert alert-success">Status pengguna berhasil diubah.</div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">
        <h2 class="h5 mb-0">Manajemen Pelanggan</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pelanggan_list as $pelanggan): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pelanggan['nama_lengkap']); ?></td>
                        <td><?php echo htmlspecialchars($pelanggan['email']); ?></td>
                        <td><?php echo date('d M Y', strtotime($pelanggan['tanggal_registrasi'])); ?></td>
                        <td>
                            <span class="badge bg-<?php echo ($pelanggan['status'] == 'aktif') ? 'success' : 'danger'; ?>">
                                <?php echo ucfirst($pelanggan['status']); ?>
                            </span>
                        </td>
                        <td>
                            <form action="../../includes/actions/proses_ubah_status_pengguna.php" method="POST" onsubmit="return confirm('Anda yakin ingin mengubah status pelanggan ini?');">
                                <input type="hidden" name="id" value="<?php echo $pelanggan['id_user']; ?>">
                                <input type="hidden" name="tipe" value="pelanggan">
                                <?php if($pelanggan['status'] == 'aktif'): ?>
                                    <input type="hidden" name="aksi" value="nonaktifkan">
                                    <button type="submit" class="btn btn-warning btn-sm">Nonaktifkan</button>
                                <?php else: ?>
                                    <input type="hidden" name="aksi" value="aktifkan">
                                    <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="h5 mb-0">Manajemen Mitra Jasa</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama Jasa</th>
                        <th>Penanggung Jawab</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach($mitra_list as $mitra): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mitra['nama_js']); ?></td>
                        <td><?php echo htmlspecialchars($mitra['penanggung_jawab']); ?></td>
                        <td><?php echo htmlspecialchars($mitra['email']); ?></td>
                        <td>
                            <span class="badge bg-<?php echo ($mitra['status'] == 'aktif') ? 'success' : ($mitra['status'] == 'menunggu' ? 'warning text-dark' : 'danger'); ?>">
                                <?php echo ucfirst($mitra['status']); ?>
                            </span>
                        </td>
                        <td>
                            <form action="../../includes/actions/proses_ubah_status_pengguna.php" method="POST" onsubmit="return confirm('Anda yakin ingin mengubah status mitra ini?');">
                                <input type="hidden" name="id" value="<?php echo $mitra['id_js']; ?>">
                                <input type="hidden" name="tipe" value="mitra">
                                <?php if($mitra['status'] == 'aktif' || $mitra['status'] == 'menunggu'): ?>
                                    <input type="hidden" name="aksi" value="nonaktifkan">
                                    <button type="submit" class="btn btn-warning btn-sm">Nonaktifkan</button>
                                <?php else: ?>
                                    <input type="hidden" name="aksi" value="aktifkan">
                                    <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../includes/templates/footer.php'; ?>