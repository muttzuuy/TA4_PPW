<?php

function format_phone($phone) {
    
    $phone = preg_replace("/[^\d]/", "", $phone);
    
    $length = strlen($phone);
    
    if ($length >= 10 && $length <= 13) {
        
        if ($length == 10) {
            return preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $phone);
        } 
        
        elseif ($length == 11) {
            return preg_replace("/^(\d{4})(\d{3})(\d{4})$/", "($1) $2-$3", $phone);
        }
        
        elseif ($length == 12) {
            return preg_replace("/^(\d{4})(\d{4})(\d{4})$/", "($1) $2-$3", $phone);
        }
        
        elseif ($length == 13) {
            return preg_replace("/^(\d{4})(\d{4})(\d{5})$/", "($1) $2-$3", $phone);
        }
    } 
    
    return $phone;
}

function sanitize_output($data) {
    if (is_array($data)) {
        return array_map('sanitize_output', $data);
    }
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function format_validation_errors($errors) {
    if (empty($errors)) {
        return '';
    }
    
    $output = '<div class="alert alert-danger" role="alert"><p class="fw-bold mb-1">❌ Validasi Gagal (PHP Error):</p><ul class="mb-0">';
    
    foreach ($errors as $error_msg) {
        $output .= '<li>' . htmlspecialchars($error_msg) . '</li>';
    }
    
    $output .= '</ul></div>';
    return $output;
}
?>