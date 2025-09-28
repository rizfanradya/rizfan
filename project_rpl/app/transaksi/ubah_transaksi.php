<?php
// File: ubah_transaksi.php
include 'koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';
$transaksi = null;

// Jika ID ada, ambil data dari database
if ($id) {
    $sql_select = "SELECT * FROM transaksi WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql_select);
    if ($result) {
        $transaksi = mysqli_fetch_assoc($result);
    }
}

// Jika data tidak ditemukan, redirect ke halaman utama
if (!$transaksi) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Data Pengiriman</title>
    <style>
        body { font-family: sans-serif; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="date"], select { width: 300px; padding: 8px; }
        input[type="submit"], a { padding: 10px 15px; border-radius: 3px; text-decoration: none; border: none; cursor: pointer; }
        input[type="submit"] { background-color: #ffc107; color: black; }
        a { background-color: #6c757d; color: white; }
        .container { padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Ubah Data Pengiriman (ID: <?php echo htmlspecialchars($transaksi['id']); ?>)</h1>
    <form action="proses_ubah.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($transaksi['id']); ?>">
        
        <div class="form-group">
            <label for="iduser">ID User:</label>
            <input type="text" id="iduser" name="id_user" value="<?php echo htmlspecialchars($transaksi['id_user']); ?>" readonly style="background-color:#e9ecef;">
        </div>
        <div class="form-group">
            <label for="idlayanan">Jenis Layanan:</label>
            <select id="idlayanan" name="id_layanan" required>
                <option value="">-- Pilih Layanan --</option>
                <?php
                $sql_layanan = "SELECT id, nama, harga_per_km FROM layanan";
                $result_layanan = mysqli_query($koneksi, $sql_layanan);
                while ($layanan = mysqli_fetch_assoc($result_layanan)) {
                    $selected = ($layanan['id'] == $transaksi['id_layanan']) ? 'selected' : '';
                    echo "<option value='" . $layanan['id'] . "' data-harga='" . $layanan['harga_per_km'] . "' $selected>" . htmlspecialchars($layanan['nama']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="asal">Alamat Asal:</label>
            <input type="text" id="asal" name="alamat_asal" value="<?php echo htmlspecialchars($transaksi['alamat_asal']); ?>" required>
        </div>
        <div class="form-group">
            <label for="tujuan">Alamat Tujuan:</label>
            <input type="text" id="tujuan" name="alamat_tujuan" value="<?php echo htmlspecialchars($transaksi['alamat_tujuan']); ?>" required>
        </div>
        <div class="form-group">
            <label for="jarak">Jarak (KM):</label>
            <input type="text" id="jarak" name="jarak" value="<?php echo htmlspecialchars($transaksi['jarak']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Tanggal Pengiriman:</label>
            <input type="date" id="date" name="tanggal_pengiriman" value="<?php echo htmlspecialchars($transaksi['tanggal_pengiriman']); ?>" required>
        </div>
        <div class="form-group">
            <label for="total">Total Harga (Rp):</label>
            <input type="text" id="total" name="total_harga" value="<?php echo htmlspecialchars($transaksi['total_harga']); ?>" readonly style="background-color:#e9ecef;">
        </div>

        <input type="submit" value="UBAH SIMPAN">
        <a href="index.php">KEMBALI</a>
    </form>
</div>

<script>
    // (Gunakan JavaScript yang sama dari tambah_transaksi.php)
    const idLayanan = document.getElementById('idlayanan');
    const jarakInput = document.getElementById('jarak');
    const totalInput = document.getElementById('total');

    function hitungTotal() {
        const selectedOption = idLayanan.options[idLayanan.selectedIndex];
        const hargaPerKm = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        const jarak = parseFloat(jarakInput.value) || 0;
        const total = hargaPerKm * jarak;
        totalInput.value = total.toFixed(0);
    }

    idLayanan.addEventListener('change', hitungTotal);
    jarakInput.addEventListener('input', hitungTotal);
</script>

</body>
</html>