<?php
  session_start();
  $time = $_SERVER['REQUEST_TIME'];
  $timeout_duration = 100;
  if ( isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration ) {
    session_unset();
    session_destroy();
    session_start();
  }
  $_SESSION['LAST_ACTIVITY'] = $time;

  if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || !isset($_SESSION['avatar']) || ($_SESSION['level'] != 2 && $_SESSION['level'] != 3) ){
    header("location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thông báo</title>
  <!-- Icon trang web -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- BootStrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet"/>
  <link href="css/override.css" rel="stylesheet" />
</head>
<body id="page-top">
  <!-- VIEWS -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="assets/img/navbar-logo.svg" /></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu<i class="fas fa-bars ml-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto mr-5">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#portfolio">GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#services">TÌM GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#about">ĐÁNH GIÁ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#contact">LIÊN HỆ</a></li>
        </ul>
      </div>
      <?php require_once('views/display_login.php') ?>
    </div>
  </nav>
  <!-- END VIEWS -->
  <br>
  <br>
  <br>
  <div class="container">
    <h4 class="mt-3" style="text-align:center">Thông báo của tôi</h4>
    <div class="row">
      <div class="col">
        <table class="table table-hover table-striped mt-2" style="text-align:center">
          <thead class="thead-dark">
            <tr>
              <th></th>
              <th style="width:20%">Người gửi</th>
              <th style="width:15%">Số điện thoại</th>
              <th style="width:40%">Nội dung</th>
              <th style="width:15%">Ngày</th>
              <th style="width:10%">Action</th>
            </tr>
          </thead>
          <tbody id="content">
            
          </tbody>
        </table>
        <button class="button-phd" data-toggle="modal" href="#updateThoiGianDay">Thay đổi</button>
      </div>
    </div>
  </div>

  <!-- My JavaScript -->
  <script src="js/myScript.js"></script>
</body>