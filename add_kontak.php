<h2 class="mb-3"><i class="fas fa-user-plus me-2"></i> Tambah Kontak Baru</h2>
<a href="index.php" class="btn btn-outline-secondary mb-4"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>

<div class="card shadow-lg border-0">
    <div class="card-header card-header-accent">
        <h5 class="mb-0">Form Input Data Kontak Baru</h5>
    </div>
    <div class="card-body p-4">
        <?php 
        
        $all_errors = [];
        if (!empty($errors) && is_array($errors)) {
            $all_errors = array_values($errors);
        }
        ?>

        <?php if (!empty($all_errors)): ?>
            <div class="alert alert-danger" role="alert">
                <p class="fw-bold mb-1">❌ Validasi Gagal (PHP Error):</p>
                <ul class="mb-0">
                    <?php foreach ($all_errors as $error_msg): ?>
                        <li><?= htmlspecialchars($error_msg) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">
                    <i class="fas fa-user-tag me-1"></i> Nama Lengkap:
                </label>
                <input type="text" 
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                       id="name" name="name" 
                       value="<?= htmlspecialchars($form_data['name'] ?? '') ?>" 
                       required>
                <?php if(isset($errors['name'])): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['name']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">
                    <i class="fas fa-envelope me-1"></i> Email:
                </label>
                <input type="email" 
                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                       id="email" name="email" 
                       value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" 
                       required>
                <?php if(isset($errors['email'])): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['email']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="phone" class="form-label fw-bold">
                    <i class="fas fa-phone-alt me-1"></i> Nomor Telepon:
                </label>
                <input type="text" 
                       class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" 
                       id="phone" name="phone" 
                       value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>" 
                       required>
                <?php if(isset($errors['phone'])): ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['phone']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-success mt-3 w-100 py-2">
                <i class="fas fa-save"></i> Simpan Kontak
            </button>
        </form>
    </div>
</div>