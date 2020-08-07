<?php
  require_once('controllers/check_session.php');
  if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || !isset($_SESSION['avatar']) || $_SESSION['level'] != 2){
    header("location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản lý dạy học</title>
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
      <a class="navbar-brand js-scroll-trigger" href="index.php">GSD<i class="fas fa-chalkboard-teacher" style="font-size: 40px; margin-left:5px"></i></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu<i class="fas fa-bars ml-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#portfolio">GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#services">TÌM GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#about">ĐÁNH GIÁ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#contact">LIÊN HỆ</a></li>
        </ul>
        <?php require_once('views/display_login.php'); ?>
      </div>
    </div>
  </nav>
  <!-- END VIEWS -->
  <br>
  <br>
  <br>
  <div class="container">
    <h4 class="mt-3" style="text-align:center">Thời Gian Dạy</h4>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
        <table class="table table-hover table-responsive mt-2" style="text-align:center;">
          <thead class="thead-dark" style="width:auto">
            <tr>
              <th style="width:16%"></th>
              <th style="width:12%">Thứ hai</th>
              <th style="width:12%">Thứ ba</th>
              <th style="width:12%">Thứ tư</th>
              <th style="width:12%">Thứ năm</th>
              <th style="width:12%">Thứ sáu</th>
              <th style="width:12%">Thứ bảy</th>
              <th style="width:12%">Chủ nhật</th>
            </tr>
          </thead>
          <tbody id="content">
            <?php require_once('views/display_thoigianday_gs.php'); ?>
          </tbody>
        </table>
        <center>
          <button class="btn-phd btn-phd-sM" data-toggle="modal" href="#updateThoiGianDay">Thay đổi</button>
        </center>
      </div>
      <div class="col-1"></div>
    </div>
  
    <h4 class="mt-5" style="text-align:center">Các Môn Dạy</h4>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <?php require_once('views/display_monday_gs.php'); ?>
      </div>
      <div class="col-2"></div>
      <button class="btn-phd btn-phd-pC btn-phd-sM" data-toggle="modal" href="#insertMonDay">Thêm môn</button>
    </div>
  </div>
  
  <!-- MODAL LIST -->
  <div class="modal fade" id="updateThoiGianDay">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thời Gian Dạy</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Thứ hai:</strong></span>
            </div>
            <select class="form-control" id="thuhai" name="thuhai">
              <option value="0">-- Chọn thời gian --</option>
              <option value="1">Sáng</option>
              <option value="2">Chiều</option>
              <option value="3">Tối</option>
              <option value="12">Sáng + Chiều</option>
              <option value="13">Sáng + Tối</option>
              <option value="23">Chiều + Tối</option>
              <option value="123">Sáng + Chiều + Tối</option>
              <option value="0">Không dạy</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Thứ ba:</strong></span>
            </div>
            <select class="form-control" id="thuba" name="thuba">
              <option value="0">-- Chọn thời gian --</option>
              <option value="1">Sáng</option>
              <option value="2">Chiều</option>
              <option value="3">Tối</option>
              <option value="12">Sáng + Chiều</option>
              <option value="13">Sáng + Tối</option>
              <option value="23">Chiều + Tối</option>
              <option value="123">Sáng + Chiều + Tối</option>
              <option value="0">Không dạy</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Thứ tư:</strong></span>
            </div>
            <select class="form-control" id="thutu" name="thutu">
              <option value="0">-- Chọn thời gian --</option>
              <option value="1">Sáng</option>
              <option value="2">Chiều</option>
              <option value="3">Tối</option>
              <option value="12">Sáng + Chiều</option>
              <option value="13">Sáng + Tối</option>
              <option value="23">Chiều + Tối</option>
              <option value="123">Sáng + Chiều + Tối</option>
              <option value="0">Không dạy</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Thứ năm:</strong></span>
            </div>
            <select class="form-control" id="thunam" name="thunam">
              <option value="0">-- Chọn thời gian --</option>
              <option value="1">Sáng</option>
              <option value="2">Chiều</option>
              <option value="3">Tối</option>
              <option value="12">Sáng + Chiều</option>
              <option value="13">Sáng + Tối</option>
              <option value="23">Chiều + Tối</option>
              <option value="123">Sáng + Chiều + Tối</option>
              <option value="0">Không dạy</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Thứ sáu:</strong></span>
            </div>
            <select class="form-control" id="thusau" name="thusau">
              <option value="0">-- Chọn thời gian --</option>
              <option value="1">Sáng</option>
              <option value="2">Chiều</option>
              <option value="3">Tối</option>
              <option value="12">Sáng + Chiều</option>
              <option value="13">Sáng + Tối</option>
              <option value="23">Chiều + Tối</option>
              <option value="123">Sáng + Chiều + Tối</option>
              <option value="0">Không dạy</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Thứ bảy:</strong></span>
            </div>
            <select class="form-control" id="thubay" name="thubay">
              <option value="0">-- Chọn thời gian --</option>
              <option value="1">Sáng</option>
              <option value="2">Chiều</option>
              <option value="3">Tối</option>
              <option value="12">Sáng + Chiều</option>
              <option value="13">Sáng + Tối</option>
              <option value="23">Chiều + Tối</option>
              <option value="123">Sáng + Chiều + Tối</option>
              <option value="0">Không dạy</option>
            </select>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Chủ nhật:</strong></span>
            </div>
            <select class="form-control" id="chunhat" name="chunhat">
              <option value="0">-- Chọn thời gian --</option>
              <option value="1">Sáng</option>
              <option value="2">Chiều</option>
              <option value="3">Tối</option>
              <option value="12">Sáng + Chiều</option>
              <option value="13">Sáng + Tối</option>
              <option value="23">Chiều + Tối</option>
              <option value="123">Sáng + Chiều + Tối</option>
              <option value="0">Không dạy</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <?php
            echo '<button class="btn-phd btn-phd-pC" onclick="updateThoiGianDay(';
            echo "'" . $_SESSION['username'] . "'"; 
            echo ')">Cập nhật</button>';
          ?>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="insertMonDay">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Môn Dạy</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Khóa học:</strong></span>
            </div>
            <select class="form-control" id="khoahoc" name="khoahoc" onchange="getCTMH(this)">
              <option value="">-- Chọn khóa học --</option>
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
              <span class="input-group-text"><strong>Môn học:</strong></span>
            </div>
            <select class="form-control" id="monhoc" name="monhoc"></select>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Học phí:</strong></span>
            </div>
            <input type="number" class="form-control only-number" id="hocphi" name="hocphi" placeholder="Học phí dự kiến 1 buổi (2h-3h)">
          </div>
        </div>
        <div class="modal-footer">
          <?php
            echo '<button class="btn-phd btn-phd-pC" onclick="insertMonDay(';
            echo "'" . $_SESSION['username'] . "'"; 
            echo ')">Cập nhật</button>';
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- END MODAL LIST -->
  
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