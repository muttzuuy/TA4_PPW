<?php
include 'includes/helper.php';

$id = $_GET['id'] ?? null;

if (empty($id) || !isset($_SESSION['contacts'][$id])) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => "Kontak tidak ditemukan atau ID tidak valid!"];
    header("Location: index.php");
    exit();
}

$contact_to_edit = $_SESSION['contacts'][$id];
$pageTitle = "Edit Kontak: " . htmlspecialchars($contact_to_edit['name']);
$errors = [];
$form_data = $contact_to_edit; 

if (isset($contact_to_edit['owner']) && $contact_to_edit['owner'] !== $_SESSION['username']) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => "Akses Ditolak: Anda tidak memiliki izin untuk mengedit kontak ini."];
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validation_result = validate_contact($_POST);
    
    $errors = $validation_result['errors'];
    $sanitized_data = $validation_result['data'];
    $form_data = $_POST; 

    if (empty($errors)) {
        
        $sanitized_data['owner'] = $_SESSION['username']; 
        
        $_SESSION['contacts'][$id] = $sanitized_data;
        
        $_SESSION['message'] = ['type' => 'info', 'text' => "Kontak **{$sanitized_data['name']}** berhasil diubah!"];
        header("Location: index.php");
        exit();
    }
}

include 'includes/_header.php';
include 'views/edit_kontak.php';
include 'includes/_footer.php';
?>