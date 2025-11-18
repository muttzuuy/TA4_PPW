<?php
include 'includes/helper.php';
$pageTitle = "Hapus Data Kontak"; 

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    $_SESSION['message'] = ['type' => 'danger', 'text' => "Akses tidak valid. Proses penghapusan harus menggunakan metode GET."];
    header("Location: index.php");
    exit();
}

$id = $_GET['id'] ?? null; 

if (empty($id)) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => "ID kontak tidak ditemukan dalam permintaan."];
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['contacts'][$id])) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => "Kontak dengan ID tersebut tidak ditemukan atau sudah dihapus."];
} else {
    $contact_to_delete = $_SESSION['contacts'][$id];
    
    if (isset($contact_to_delete['owner']) && $contact_to_delete['owner'] !== $_SESSION['username']) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => "Akses Ditolak: Anda tidak memiliki izin untuk menghapus kontak ini."];
        header("Location: index.php");
        exit();
    }
    
    $contact_name = $contact_to_delete['name'];
    
    unset($_SESSION['contacts'][$id]); 
    
    $_SESSION['message'] = [
        'type' => 'success', 
        'text' => "Kontak **" . htmlspecialchars($contact_name) . " berhasil dihapus."
    ];
}

header("Location: index.php");
exit();
?>