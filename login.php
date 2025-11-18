<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg mt-5 border-0">
            <div class="card-header card-header-accent">
                <h4 class="mb-0 text-center fw-bold">
                    <i class="fas fa-lock me-2"></i> Akses Sistem Kontak
                </h4>
            </div>
            
            <div class="card-body p-4">
                <?php if ($login_error): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> <?= $login_error ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">
                            <i class="fas fa-user"></i> Username:
                        </label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">
                            <i class="fas fa-key"></i> Password:
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-sign-in-alt"></i> LOGIN
                    </button>
                </form>
                
                <p class="text-center mt-4 mb-2">
                    <small>Belum punya akun? <a href="register.php" class="text-accent-link fw-bold">Daftar di sini</a></small>
                </p>
                
                <hr class="my-2">
                
                <p class="text-center">
                    <a href="login.php?debug=show" class="text-muted"><small><i class="fas fa-terminal"></i> Tampilkan Session Data</small></a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['debug']) && $_GET['debug'] == 'show') {
?>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h5 class="mt-4 text-center">Data Debug Saat Ini</h5>
            <div class="debug-box mb-3">
                <p class="fw-bold mb-1">DATA SESSION:</p>
                <pre><?php print_r(clean_session_data($_SESSION)); ?></pre>
            </div>
            <div class="debug-box">
                <p class="fw-bold mb-1">DATA COOKIE:</p>
                <pre><?php print_r($_COOKIE); ?></pre>
            </div>
        </div>
    </div>
<?php
}
?>