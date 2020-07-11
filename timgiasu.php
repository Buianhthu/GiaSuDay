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

  if( !isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || !isset($_SESSION['avatar']) || $_SESSION['level'] != 3){
    header("location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đăng bài tìm gia sư</title>
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
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet"/>
  <link href="css/override.css" rel="stylesheet" />
</head>
<body id="page-top">

  <!-- VIEWS -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="assets/img/navbar-logo.svg" /></a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
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
  <br>
  <div class="container">
    <div id="notification"></div>
    <div class="mb-4" style="text-align:center"><h4>ĐĂNG BÀI TÌM GIA SƯ</h4></div>
    <!-- FORM INSERT -->
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Môn học :</strong></span>
      </div>
      <select class="form-control" id="monhoc" name="monhoc" onchange="getCTMH(this)">
        <option value="">-- Chọn môn --</option>
        <option value="Khoa Học Tự Nhiên">Khoa Học Tự Nhiên</option>
        <option value="Lập Trình Căn Bản">Lập Trình Căn Bản</option>
        <option value="Lập Trình Web">Lập Trình Web</option>
        <option value="Lập Trình Mobile">Lập Trình Mobile</option>
        <option value="Lập Trình Game">Lập Trình Game</option>
        <option value="Lập Trình Hệ Thống">Lập Trình Hệ Thống</option>
        <option value="Tin Học Văn Phòng">Tin Học Văn Phòng</option>
      </select>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Môn chi tiết :</strong></span>
      </div>
      <select class="form-control" id="chitietmonhoc" name="chitietmonhoc"></select>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Môn mới :</strong></span>
      </div>
      <input type="text" class="form-control" id="monmoi" name="monmoi" placeholder="Nếu trong danh sách môn chi tiết không có thì điền ở đây, không thì để trống">
    </div>
    <div class="form-group">
      <label class="ml-2" for="noidung"><strong>Nội dung :</strong></label>
      <textarea class="form-control" rows="5" width="100%" id="noidung" placeholder="Điền nội dung rõ ràng, ghi dấu để bài viết được phê duyệt"></textarea>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Thời gian học :</strong></span>
      </div>
      <input type="text" class="form-control" id="thoigianhoc" name="thoigianhoc" placeholder="Ví dụ: thứ bảy (15h - 18h), thứ hai (9h - 11h),...">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Học phí :</strong></span>
      </div>
      <input type="text" class="form-control" id="hocphi" name="hocphi" onkeypress="validateNumber(event)" placeholder="Số tiền một buổi học bạn dự kiến trả, sẽ còn thương lượng với gia sư nhận lớp">
    </div>
    <div class="form-group" style="text-align:center">
      <?php 
        echo '<button class="btn btn-danger" type="submit" onclick="insertTimGiaSu(';
        echo "'" . $_SESSION['username'] . "'"; 
        echo ')">Đăng bài</button>';
      ?>
    </div>
    <!-- END FORM-->
  </div>

  <!-- My JavaScript -->
  <script src="js/myScript.js"></script>
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <!-- Contact form JS-->
  <script src="assets/mail/jqBootstrapValidation.js"></script>
  <script src="assets/mail/contact_me.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>

</body>