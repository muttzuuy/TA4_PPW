<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/utils.php';

if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}
if (!isset($_SESSION['users'])) {
    
    $_SESSION['users'] = [
        'admin' => [
            'username' => 'admin',
            'password_hash' => password_hash('123456', PASSWORD_DEFAULT),
            'email' => 'admin@kontak.com'
        ]
    ];
}

if (!isset($_COOKIE['app_color_preference'])) {
    setcookie('app_color_preference', 'teal-coral', time() + (86400 * 30), "/"); 
}

function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function require_login() {
    if (!is_logged_in()) {
        $_SESSION['message'] = ['type' => 'warning', 'text' => "Anda harus **Login** untuk mengakses halaman ini."];
        header("Location: login.php");
        exit();
    }
}

function register_user($data) {
    global $_SESSION;
    
    if (isset($_SESSION['users'][$data['username']])) {
        return "Username '{$data['username']}' sudah terdaftar.";
    }

    $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

    $_SESSION['users'][$data['username']] = [
        'username' => $data['username'],
        'password_hash' => $password_hash,
        'email' => $data['email'] 
    ];
    
    return true; 
}

function authenticate_user($username, $password) {
    global $_SESSION;
    if (isset($_SESSION['users'][$username])) {
        $user = $_SESSION['users'][$username];
        if (password_verify($password, $user['password_hash'])) {
            return $user; 
        }
    }
    return false; 
}
function validate_contact($data) {
    $errors = []; 
    $clean_data = [];

    $name = trim($data['name'] ?? '');
    if (empty($name)) { $errors['name'] = "Nama wajib diisi."; } 
    else {
        $clean_data['name'] = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        if (!preg_match("/^[a-zA-Z\s]+$/", $clean_data['name'])) {
            $errors['name'] = "Nama hanya boleh mengandung huruf dan spasi.";
        }
    }

    $email = trim($data['email'] ?? '');
    if (empty($email)) { $errors['email'] = "Email wajib diisi."; } 
    else {
        $clean_data['email'] = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($clean_data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format email tidak valid (misal: user@domain.com).";
        }
    }

    $phone = trim($data['phone'] ?? '');
    if (empty($phone)) { $errors['phone'] = "Nomor Telepon wajib diisi."; } 
    else {
        $sanitized_phone = preg_replace("/[^\d\s\-\(\)]/", "", $phone);
        $clean_data['phone'] = htmlspecialchars($sanitized_phone, ENT_QUOTES, 'UTF-8');
        $numeric_phone = preg_replace("/[^\d]/", "", $clean_data['phone']);
        if (strlen($numeric_phone) < 5) { 
            $errors['phone'] = "Nomor Telepon harus mengandung minimal 5 digit angka.";
        }
    }
    
    return ['errors' => $errors, 'data' => $clean_data];
}

function display_debug_data() {
    if (isset($_GET['debug']) && $_GET['debug'] == 'show') {
        ?>
        <hr class="my-5">
        <h3 class="mb-3">🔬 Debug Data Server (Untuk Pemeriksaan Tugas)</h3>
        <div class="alert alert-warning">
            **PENTING:** Informasi di bawah ini hanya muncul karena URL mengandung parameter `?debug=show`.
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold">SESSION DATA (ID: <?= htmlspecialchars(session_id()) ?>)</h5>
                <div class="debug-box">
                    <pre><?php print_r($_SESSION); ?></pre>
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold">COOKIE DATA</h5>
                <div class="debug-box">
                    <pre><?php print_r($_COOKIE); ?></pre>
                </div>
            </div>
        </div>
        <?php
    }
}


// Redirect wajib login, kecuali di login.php atau index.php atau register.php
if (
    basename($_SERVER['PHP_SELF']) !== 'login.php' && 
    basename($_SERVER['PHP_SELF']) !== 'index.php' && 
    basename($_SERVER['PHP_SELF']) !== 'register.php' 
) {
    require_login();
}
?>