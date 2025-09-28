<?php
// ---- LOGIKA PHP UNTUK PROSES REGISTRASI ----
include '../../includes/koneksi.php';

// Mengatur mysqli untuk melaporkan error sebagai exceptions agar bisa ditangkap 'try-catch'
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$message = '';
$message_type = '';

// Cek jika form sudah di-submit dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil semua data dari form
    $nama_js = $_POST['nama_js'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $cabang = $_POST['cabang'];
    $tanggal_terdaftar = date('Y-m-d'); // Tanggal hari ini
    $status_default = 'menunggu'; // Status awal untuk mitra baru

    // Validasi sederhana untuk memastikan tidak ada kolom yang kosong
    if (empty($nama_js) || empty($penanggung_jawab) || empty($username) || empty($password) || empty($no_telepon) || empty($email) || empty($alamat) || empty($cabang)) {
        $message = "Semua kolom wajib diisi.";
        $message_type = 'error';
    } else {
        // Enkripsi password sebelum disimpan ke database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Siapkan query SQL untuk memasukkan data baru
            $query = "INSERT INTO nama_js (nama_js, penanggung_jawab, username, password, no_telepon, email, alamat, cabang, tanggal_terdaftar, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($koneksi, $query);

            // Bind parameter ke query untuk mencegah SQL Injection
            mysqli_stmt_bind_param($stmt, "ssssssssss", $nama_js, $penanggung_jawab, $username, $hashedPassword, $no_telepon, $email, $alamat, $cabang, $tanggal_terdaftar, $status_default);
            
            // Eksekusi statement
            mysqli_stmt_execute($stmt);

            $message = "Pendaftaran berhasil! Akun Anda akan segera kami tinjau dan aktifkan setelah dikonfirmasi oleh administrator.";
            $message_type = 'success';
        } catch (mysqli_sql_exception $e) {
            // Tangkap error jika terjadi (contoh: email duplikat)
            if ($e->getCode() == 1062) { // Kode error 1062 adalah untuk duplicate entry
                $message = "Email yang Anda daftarkan sudah digunakan. Silakan gunakan email lain.";
            } else {
                $message = "Terjadi kesalahan pada server. Silakan coba lagi nanti.";
            }
            $message_type = 'error';
        }
    }
}

// ---- PENGATURAN UNTUK HEADER ----
$page_title = 'Pendaftaran Mitra Jasa Antar';
// Variabel ini memberi tahu header untuk menampilkan navbar versi "tamu" (belum login)
$is_guest_page = true; 
include '../../includes/templates/header_guest.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="card-title text-center h3 mb-2">Daftar sebagai Mitra</h1>
                <p class="text-center text-muted mb-4">Isi data jasa Anda dengan lengkap.</p>

                <?php if ($message): ?>
                    <div class="alert <?php echo $message_type === 'success' ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <form action="register_jasa.php" method="POST">
                    <div class="mb-3">
                        <label for="nama_js" class="form-label">Nama Perusahaan / Jasa:</label>
                        <input type="text" class="form-control" id="nama_js" name="nama_js" placeholder="Contoh: Lancar Jaya Express" required>
                    </div>
                    <div class="mb-3">
                        <label for="penanggung_jawab" class="form-label">Nama Penanggung Jawab:</label>
                        <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" placeholder="Nama lengkap Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">Nomor Telepon (WhatsApp):</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="08123456789" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Perusahaan:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="kontak@lancarjaya.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap Usaha:</label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Jalan, nomor, kelurahan, kecamatan, kota" required rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cabang" class="form-label">Cabang Pendaftaran:</label>
                        <input type="text" class="form-control" id="cabang" name="cabang" placeholder="Contoh: Bandar Lampung" required>
                    </div>
                    
                    <hr class="my-4">

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Buat username untuk login" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">DAFTAR SEKARANG</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <p class="text-muted">Sudah punya akun? <a href="login.php">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Memanggil file footer yang berisi script JS Bootstrap dan penutup tag HTML
include '../../includes/templates/footer.php'; 
?>