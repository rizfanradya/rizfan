<?php
// Atur judul halaman
$page_title = "Dasbor Developer";

// [ATURAN UTAMA] Panggil header SEBAGAI BARIS PERTAMA.
// Header akan menangani sesi, login check, dan semua HTML bagian atas.
include '../../includes/templates/header_developer.php';

// Setelah header dipanggil, baru aman untuk memanggil koneksi.
include '../../includes/koneksi.php';

// Logika PHP spesifik untuk halaman ini.
// Sesi sudah dijamin aktif oleh header.

// Mengambil daftar pendaftaran jasa yang menunggu konfirmasi
$pending_list = [];
$sql_pending = "SELECT id_js, nama_js, username, tanggal_terdaftar FROM nama_js WHERE status = 'menunggu'";
$result_pending = mysqli_query($koneksi, $sql_pending);
if ($result_pending) {
    while($row = mysqli_fetch_assoc($result_pending)) {
        $pending_list[] = $row;
    }
}
?>

<?php if(isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'sukses'): ?>
    <div class="alert alert-success">Konfirmasi pendaftaran berhasil diproses.</div>
<?php elseif(isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'gagal'): ?>
    <div class="alert alert-danger">Gagal memproses konfirmasi pendaftaran.</div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">
        <h2 class="h5 mb-0"><i class="bi bi-compass-fill me-2"></i>Menu Navigasi</h2>
    </div>
    <div class="card-body">
        <p class="card-text">Kelola semua pengguna (pelanggan dan mitra) yang terdaftar di sistem.</p>
        <a href="manajemen_pengguna.php" class="btn btn-primary">Buka Manajemen Pengguna</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="h5 mb-0"><i class="bi bi-patch-check-fill me-2"></i>Konfirmasi Pendaftaran Jasa Antar</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama Jasa</th>
                        <th>Username</th>
                        <th>Tanggal Daftar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pending_list)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada pendaftaran yang menunggu konfirmasi.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pending_list as $pendaftar): ?>
                            <tr>
                                <td><?php echo $pendaftar['id_js']; ?></td>
                                <td><?php echo htmlspecialchars($pendaftar['nama_js']); ?></td>
                                <td><?php echo htmlspecialchars($pendaftar['username']); ?></td>
                                <td><?php echo date('d M Y', strtotime($pendaftar['tanggal_terdaftar'])); ?></td>
                                <td class="text-center">
                                    <a href="proses_konfirmasi.php?id=<?php echo $pendaftar['id_js']; ?>&action=approve" class="btn btn-success btn-sm">Setujui</a>
                                    <a href="proses_konfirmasi.php?id=<?php echo $pendaftar['id_js']; ?>&action=reject" class="btn btn-danger btn-sm">Tolak</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
// Panggil template footer
include '../../includes/templates/footer.php'; 
?>