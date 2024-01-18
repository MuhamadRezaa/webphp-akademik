<?php
    session_start();
    if($_SESSION['login'] == FALSE) {
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Akademik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php 
      $active=isset($_GET['p']) ? $_GET['p'] : 'active'; 
      
      ?>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $active ?>" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($active=='mhs') echo 'active' ?>" href="index.php?p=mhs">Mahasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($active=='dosen') echo 'active' ?>" href="index.php?p=dosen">Dosen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($active=='prodi') echo 'active' ?>" href="index.php?p=prodi">Prodi</a>
        </li>
        <?php
          if ($_SESSION['login'] == TRUE): 
        ?> 
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <?php endif ?>
      </ul>
      <form class="d-flex" role="search">
        <?php if($_SESSION['level'] == 'admin') { ?>
          <a class="btn btn-light me-2" type="submit" href="admin/index.php">BackEnd</a>
        <?php } ?>
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<div class="container">
    <?php
      include 'koneksi.php';
        $p=isset($_GET['p']) ? $_GET['p'] : 'home';
        if ($p=='home') include 'home.php';
        if ($p=='mhs') include 'mahasiswa.php';
        if ($p=='dosen') include 'dosen.php';
        if ($p=='prodi') include 'prodi.php';
    ?>
</div>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
    new DataTable('#tabel-mahasiswa');
    new DataTable('#tabel-dosen');
    new DataTable('#tabel-prodi');
  </script>
</body>
</html>