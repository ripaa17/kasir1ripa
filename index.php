<?php
include 'config.php';
session_start();

// print_r($_SESSION);

//fungsi dari membatasi hak akses

if (isset($_SESSION['userid'])) {
    if ($_SESSION['role_id'] == 2) {
        //redirect ke halaman kasir.php
        header('Location:kasir.php');
    }
} else {
    $_SESSION['error'] = 'Anda harus login dahulu';
    header('location:login.php');
}

 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Ripa v4.0.1">
    <title>Kasir Ripe</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <style>
      body {
        background-color: #01579b;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #EFEBE9;
        text-align: left;
        }
      
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #EFEBE9;
      }
      a {
          color: #3e2723;
      }

      .loading-overlay {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(255, 255, 255, 0.7);
          z-index: 9999;
      }

      .loading-spinner {
          border: 16px solid #f3f3f3;
          border-top: 16px solid #3498db;
          border-radius: 50%;
          width: 80px;
          height: 80px;
          position: absolute;
          top: 50%;
          left: 50%;
          margin-top: -40px;
          margin-left: -40px;
          animation: spin 1s linear infinite;
      }

      @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Admin Firman</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-important sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="index.php?=home">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=barang">
              <span data-feather="file"></span>
              Barang
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=role">
              <span data-feather="shopping-cart"></span>
              Role
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=user">
              <span data-feather="users"></span>
              User
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=dis_barang">
              <span data-feather="bar-chart-2"></span>
              Diskon Barang
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Selamat Datang Admin Firman</h1>
	  </div>
    <?php

      if (isset($_GET['page']) && $_GET['page'] != '') {
          include 'page/' . $_GET['page'] . '.php';
      } else {
          include 'page/home.php';
      }
    ?>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
  // Fungsi untuk menampilkan loading overlay
  function showLoading() {
      document.getElementById('loadingOverlay').style.display = 'block';
  }

  // Fungsi untuk menyembunyikan loading overlay
  function hideLoading() {
      document.getElementById('loadingOverlay').style.display = 'none';
  }

  // Contoh penggunaan: Tampilkan loading saat halaman dimuat
  showLoading();

  // Simulasikan proses loading selama 1 detik
  setTimeout(function() {
      // Sembunyikan loading setelah 1 detik
      hideLoading();
  }, 1000);

</script>
</body>
</html>
