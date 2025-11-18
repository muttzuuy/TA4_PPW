<?php
include 'includes/helper.php';
$pageTitle = "Tambah Kontak Baru";
$errors = [];
$form_data = [
    'name' => '', 
    'email' => '', 
    'phone' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $validation_result = validate_contact($_POST); 
    $errors = $validation_result['errors']; 
    $sanitized_data = $validation_result['data'];
    
    $form_data = $_POST; 

    if (empty($errors)) {
        $id = time() . substr(md5(microtime()), 0, 5); 
        
        while (isset($_SESSION['contacts'][$id])) {
            $id = time() . substr(md5(microtime()), 0, 5); 
        }

        if (isset($_SESSION['username'])) {
            $sanitized_data['owner'] = $_SESSION['username'];
        } else {
            $sanitized_data['owner'] = 'guest'; 
        }
        
        $_SESSION['contacts'][$id] = $sanitized_data;
        
        $_SESSION['message'] = [
            'type' => 'success', 
            'text' => "Kontak **" . htmlspecialchars($sanitized_data['name']) . "** berhasil ditambahkan!"
        ];
        
        header("Location: index.php");
        exit();
    }
}

include 'includes/_header.php';
include 'views/add_kontak.php'; 
include 'includes/_footer.php';
?>