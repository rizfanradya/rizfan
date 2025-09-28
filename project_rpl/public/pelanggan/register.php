<?php
session_start();

// Ambil pesan error jika ada, lalu hapus dari session
$errors = $_SESSION['register_errors'] ?? [];
unset($_SESSION['register_errors']);

// Ambil input lama jika ada, lalu hapus dari session
$old_input = $_SESSION['register_input'] ?? [];
unset($_SESSION['register_input']);

// DITAMBAHKAN: Variabel penanda untuk header
$page_title = "Daftar Akun Pelanggan";
$is_guest_page = true; // Ini adalah "tanda" bahwa ini adalah halaman tamu

include '../../includes/templates/header_guest.php'; // Memanggil template header
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="card-title h4 text-center mb-4">Buat Akun Baru</h1>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="../../includes/actions/register_pelanggan.php" method="POST">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($old_input['nama_lengkap'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($old_input['username'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($old_input['email'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <div class="form-text">Minimal 8 karakter.</div>
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="text" id="no_telepon" name="no_telepon" class="form-control" value="<?php echo htmlspecialchars($old_input['no_telepon'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" required><?php echo htmlspecialchars($old_input['alamat'] ?? ''); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($old_input['tanggal_lahir'] ?? ''); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">DAFTAR</button>
                    </form>

                    <div class="text-center mt-3">
                        <small>Sudah punya akun? <a href="login.php">Login di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/templates/footer.php'; ?>