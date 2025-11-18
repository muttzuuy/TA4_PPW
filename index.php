<?php
include 'includes/helper.php';

$pageTitle = "Daftar Kontak";
$contacts = $_SESSION['contacts'];
$keyword = $_GET['search'] ?? ''; 
$filtered_contacts = [];

include 'includes/_header.php';

if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    echo "<div class='alert alert-{$msg['type']} alert-dismissible fade show' role='alert'>
            <i class='fas fa-info-circle me-1'></i> {$msg['text']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

if (is_logged_in()) {
    $current_user = $_SESSION['username'];
    $user_contacts = [];
    
    foreach ($contacts as $id => $contact) {

        $user_contacts[$id] = $contact;
    }

    $filtered_contacts = $user_contacts;
    
    if (!empty($keyword)) {
        $search_results = [];
        $keyword_lower = strtolower($keyword);

        foreach ($user_contacts as $id => $contact) {
            if (str_contains(strtolower($contact['name']), $keyword_lower) ||
                str_contains(strtolower($contact['email']), $keyword_lower) ||
                str_contains($contact['phone'], $keyword)
            ) {
                $search_results[$id] = $contact;
            }
        }
        $filtered_contacts = $search_results; 
    }

    include 'views/list_kontak.php'; 
    
    $show_debug = isset($_GET['debug']) && $_GET['debug'] == 'show';
    
    echo '<div class="mt-4 text-center">';
    if (!$show_debug) {
        echo '<a href="?debug=show" class="btn btn-outline-secondary btn-sm"><i class="fas fa-bug"></i> Tampilkan Debug Session & Cookie (Wajib Tugas)</a>';
    } else {
        echo '<a href="index.php" class="btn btn-outline-danger btn-sm"><i class="fas fa-eye-slash"></i> Sembunyikan Debug Data</a>';
    }
    echo '</div>';


    if ($show_debug) {
        ?>
        <hr class="my-5">
        <h3 class="mb-3">🔬 Hasil Session Management & Cookie (Debug Output)</h3>
        <div class="alert alert-warning">
            PENTING: Data ini hanya muncul karena parameter `?debug=show` aktif.
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold">SESSION DATA (ID: <?= htmlspecialchars(session_id()) ?>)</h5>
                <div class="debug-box">
                    <p>Status Login: <code><?= $_SESSION['logged_in'] ? 'TRUE' : 'FALSE' ?></code></p>
                    <p>Username: <code><?= htmlspecialchars($_SESSION['username'] ?? 'N/A') ?></code></p>
                    <p class="fw-bold mb-1">Detail $_SESSION:</p>
                    <pre><?php print_r($_SESSION); ?></pre>
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold">COOKIE DATA</h5>
                <div class="debug-box">
                    <p>Cookie Preference: <code><?= htmlspecialchars($_COOKIE['app_color_preference'] ?? 'N/A') ?></code></p>
                    <p class="fw-bold mb-1">Detail $_COOKIE:</p>
                    <pre><?php print_r($_COOKIE); ?></pre>
                </div>
            </div>
        </div>
        <?php
    }

} else {
    echo "<h1>Selamat Datang di Sistem Manajemen Kontak</h1>";
    echo "<p>Silakan <a href='login.php'>Login</a> atau <a href='register.php'>Daftar Akun</a> untuk mulai mengelola kontak.</p>";
}

include 'includes/_footer.php';
?>