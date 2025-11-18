<?php 

$pageTitle = $pageTitle ?? "Sistem Manajemen Kontak"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
        <i class="fas fa-address-book me-2"></i> Manager Kontak
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (is_logged_in()): ?>
          <li class="nav-item me-3">
            <span class="navbar-text text-white">
              <i class="fas fa-user-circle me-1"></i> Halo, **<?= htmlspecialchars($_SESSION['username']) ?>**
            </span>
          </li>
          <li class="nav-item">
            <a class="btn btn-warning btn-sm" href="login.php?action=logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="btn btn-primary btn-sm" href="login.php">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">