<?php
// Atur judul halaman
$page_title = "Riwayat Pesanan";

// [ATURAN UTAMA] Panggil header SEBAGAI BARIS PERTAMA.
include '../../includes/templates/header_pelanggan.php';

// Baru panggil koneksi dan logika lainnya
include '../../includes/koneksi.php';

$user_id = $_SESSION['user_id'];

// Mengambil riwayat transaksi untuk user yang sedang login
$riwayat_transaksi = [];
$query_riwayat = "
    SELECT 
        t.id_transaksi, t.tanggal_transaksi, js.nama_js, jl.nama_layanan, 
        t.total_harga, t.status, u.id_ulasan
    FROM transaksi t
    JOIN nama_js js ON t.id_js = js.id_js
    JOIN jenis_layanan jl ON t.id_layanan = jl.layanan_id
    LEFT JOIN ulasan u ON t.id_transaksi = u.id_transaksi
    WHERE t.id_user = ? ORDER BY t.tanggal_transaksi DESC";
$stmt_riwayat = mysqli_prepare($koneksi, $query_riwayat);
mysqli_stmt_bind_param($stmt_riwayat, "i", $user_id);
mysqli_stmt_execute($stmt_riwayat);
$result_riwayat = mysqli_stmt_get_result($stmt_riwayat);
if ($result_riwayat) {
    while ($row = mysqli_fetch_assoc($result_riwayat)) {
        $riwayat_transaksi[] = $row;
    }
}
?>

<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h2 class="h5 card-title mb-0">Riwayat Transaksi Anda</h2>
        </div>
        
        <?php if(isset($_GET['hapus']) && $_GET['hapus'] == 'sukses'): ?>
            <div class="alert alert-success mt-3">Riwayat transaksi berhasil dihapus.</div>
        <?php endif; ?>
        <?php if(isset($_GET['batal']) && $_GET['batal'] == 'sukses'): ?>
            <div class="alert alert-success mt-3">Pesanan berhasil dibatalkan.</div>
        <?php endif; ?>

        <div class="table-responsive mt-3">
             <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jasa Pengiriman</th>
                        <th>Layanan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($riwayat_transaksi)): ?>
                        <tr><td colspan="6" class="text-center text-muted">Anda belum memiliki riwayat transaksi.</td></tr>
                    <?php else: ?>
                        <?php foreach ($riwayat_transaksi as $transaksi): ?>
                            <tr>
                                <td><?php echo date('d M Y, H:i', strtotime($transaksi['tanggal_transaksi'])); ?></td>
                                <td><?php echo htmlspecialchars($transaksi['nama_js']); ?></td>
                                <td><?php echo htmlspecialchars($transaksi['nama_layanan']); ?></td>
                                <td>Rp <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php
                                        $status_class = 'secondary';
                                        if($transaksi['status'] == 'Diproses') $status_class = 'warning text-dark';
                                        if($transaksi['status'] == 'Dijemput') $status_class = 'info text-dark';
                                        if($transaksi['status'] == 'Dikirim') $status_class = 'primary';
                                        if($transaksi['status'] == 'Selesai') $status_class = 'success';
                                        if($transaksi['status'] == 'Dibatalkan') $status_class = 'danger';
                                    ?>
                                    <span class="badge bg-<?php echo $status_class; ?>"><?php echo htmlspecialchars($transaksi['status']); ?></span>
                                </td>
                                <td>
                                    <?php if ($transaksi['status'] == 'Selesai' && is_null($transaksi['id_ulasan'])): ?>
                                        <a href="beri_ulasan.php?id_transaksi=<?php echo $transaksi['id_transaksi']; ?>" class="btn btn-primary btn-sm">Beri Ulasan</a>

                                    <?php elseif ($transaksi['status'] == 'Diproses'): ?>
                                        <form action="../../includes/actions/batal_transaksi.php" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan pesanan ini?');">
                                            <input type="hidden" name="id_transaksi" value="<?php echo $transaksi['id_transaksi']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                        </form>
                                        


                                    <?php endif; ?>
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
include '../../includes/templates/footer.php';
?>