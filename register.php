<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg mt-5 border-0">
            <div class="card-header card-header-accent text-center">
                <h4 class="mb-0 fw-bold"><i class="fas fa-user-plus me-2"></i> Buat Akun Baru</h4>
            </div>
            <div class="card-body p-4">
                <?php if ($register_error): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-times-circle me-2"></i> <?= $register_error ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold"><i class="fas fa-user"></i> Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($form_data['username'] ?? '') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold"><i class="fas fa-key"></i> Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-4">
                        <label for="confirm_password" class="form-label fw-bold"><i class="fas fa-check-double"></i> Konfirmasi Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-arrow-right-to-bracket"></i> DAFTAR
                    </button>
                </form>
                
                <p class="text-center mt-3"><small>Sudah punya akun? <a href="login.php" class="text-accent-link">Login di sini</a></small></p>
            </div>
        </div>
    </div>
</div>