<?php
// WAJIB: Memulai session di baris paling atas
session_start();

// Cek apakah user sudah login. Jika belum, redirect ke halaman login.
// Ganti 'login.php' jika nama file login Anda berbeda.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Mengambil ID user dari session
$id_user_login = $_SESSION['user_id'];

// Memasukkan file koneksi
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Pengiriman Barang</title>
    <style>
        body { font-family: sans-serif; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold;}
        input[type="text"], input[type="date"], select { width: calc(100% - 18px); padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"], a { padding: 10px 15px; border-radius: 3px; text-decoration: none; border: none; cursor: pointer; }
        input[type="submit"] { background-color: #28a745; color: white; }
        a { background-color: #6c757d; color: white; display: inline-block; }
        .container { padding: 20px; max-width: 500px; margin: auto; background-color:#f9f9f9; border-radius: 8px;}
    </style>
</head>
<body>

<div class="container">
    <h1>Input Pengiriman Barang</h1>
    <form action="proses_tambah.php" method="POST">
        
        <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($id_user_login); ?>">

        <div class="form-group">
            <label for="nama_pengirim">Nama Pengirim:</label>
            <input type="text" id="nama_pengirim" name="nama_pengirim" required>
        </div>
        <div class="form-group">
            <label for="asal">Alamat Penjemputan:</label>
            <input type="text" id="asal" name="alamat_penjemputan" required>
        </div>
        <hr style="border: 1px dashed #ccc; margin: 20px 0;">
        <div class="form-group">
            <label for="nama_penerima">Nama Penerima:</label>
            <input type="text" id="nama_penerima" name="nama_penerima" required>
        </div>
        <div class="form-group">
            <label for="tujuan">Alamat Tujuan:</label>
            <input type="text" id="tujuan" name="alamat_tujuan" required>
        </div>
        <hr style="border: 1px dashed #ccc; margin: 20px 0;">
        <div class="form-group">
            <label for="id_js">Jasa Antar:</label>
            <select id="id_js" name="id_js" required>
                <option value="">-- Pilih Jasa Antar --</option>
                <?php
                $sql_jasa = "SELECT * FROM nama_js WHERE status = 'aktif'";
                $result_jasa = mysqli_query($koneksi, $sql_jasa);
                while ($jasa = mysqli_fetch_assoc($result_jasa)) {
                    echo "<option value='" . $jasa['id_js'] . "'>" . htmlspecialchars($jasa['nama_js']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idlayanan">Jenis Layanan:</label>
            <select id="idlayanan" name="id_layanan" required>
                <option value="">-- Pilih Layanan --</option>
                <?php
                $sql_layanan = "SELECT * FROM layanan";
                $result_layanan = mysqli_query($koneksi, $sql_layanan);
                while ($layanan = mysqli_fetch_assoc($result_layanan)) {
                    echo "<option value='" . $layanan['id_layanan'] . "' data-harga='" . $layanan['harga_per_km'] . "'>" . htmlspecialchars($layanan['nama_layanan']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="jarak">Jarak (KM):</label>
            <input type="text" id="jarak" name="jarak" required>
        </div>
        <div class="form-group">
            <label for="date">Tanggal Pengiriman:</label>
            <input type="date" id="date" name="tanggal_pengiriman" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group">
            <label for="total">Total Harga (Rp):</label>
            <input type="text" id="total" name="total_harga" readonly style="background-color:#e9ecef;">
        </div>

        <input type="submit" value="INPUT">
        <a href="index.php">KEMBALI</a>
    </form>
</div>

<script>
    // JavaScript untuk menghitung total harga (tidak perlu diubah)
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