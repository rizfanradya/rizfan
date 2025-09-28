<?php
// File: layanan.php
include 'koneksi.php'; // Mengimpor file koneksi

// Logika untuk memproses penambahan layanan baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_layanan'])) {
    $nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga_per_km = mysqli_real_escape_string($koneksi, $_POST['harga_per_km']);
    $tanggal_ditambahkan = mysqli_real_escape_string($koneksi, $_POST['tanggal_ditambahkan']);

    $sql_insert = "INSERT INTO layanan (nama_layanan, deskripsi, harga_per_km, tanggal_ditambahkan) VALUES ('$nama_layanan', '$deskripsi', '$harga_per_km', '$tanggal_ditambahkan')";

    if (!mysqli_query($koneksi, $sql_insert)) {
        echo "Error: " . mysqli_error($koneksi);
    }
    // Redirect untuk menghindari re-submit form saat refresh
    header("Location: layanan.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jenis Layanan</title>
    <style>
        /* (Gunakan CSS yang sama dari index.php atau buat file CSS terpisah) */
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; padding: 5px 10px; color: white; border-radius: 3px; }
        a.hapus { background-color: #dc3545; }
        .container { padding: 20px; max-width: 900px; margin: auto; }
        .form-card { background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 30px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="date"] { width: calc(100% - 18px); padding: 8px; }
        input[type="submit"] { padding: 10px 15px; border-radius: 3px; border: none; cursor: pointer; background-color: #28a745; color: white; }
    </style>
</head>
<body>

<div class="container">
    <a href="index.php"><< Kembali ke Data Transaksi</a>

    <h1>Kelola Jenis Layanan</h1>

    <div class="form-card">
        <h2>Tambah Layanan Baru</h2>
        <form action="layanan.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Layanan:</label>
                <input type="text" id="nama_layanan" name="nama_layanan" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" id="deskripsi" name="deskripsi" required>
            </div>
            <div class="form-group">
                <label for="harga_per_km">Harga / KM:</label>
                <input type="text" id="harga_per_km" name="harga_per_km" required>
            </div>
             <div class="form-group">
                <label for="tanggal_ditambahkan">Tanggal Ditambahkan:</label>
                <input type="date" id="tanggal_ditambahkan" name="tanggal_ditambahkan" required>
            </div>
            <input type="submit" name="tambah_layanan" value="TAMBAH LAYANAN">
            <a href="index.php">KEMBALI</a>
        </form>
    </div>

    <h2>Daftar Layanan Saat Ini</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga / KM</th>
                <th>Tanggal Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_select = "SELECT * FROM layanan";
            $result = mysqli_query($koneksi, $sql_select);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_layanan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_layanan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                    echo "<td>Rp " . number_format($row['harga_per_km'], 0, ',', '.') . "</td>";
                    echo "<td>" . htmlspecialchars($row['tanggal_ditambahkan']) . "</td>";
                    echo "<td>";
                    echo "<a href='hapus_layanan.php?id=" . $row['id_layanan'] . "' class='hapus' onclick='return confirm(\"Yakin ingin menghapus layanan ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Belum ada data layanan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>