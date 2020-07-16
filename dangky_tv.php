<?php
  session_start();
  $time = $_SERVER['REQUEST_TIME'];
  $timeout_duration = 30;
  if ( isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration ) {
    session_unset();
    session_destroy();
    session_start();
  }
  $_SESSION['LAST_ACTIVITY'] = $time;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet"/>
  <link href="css/override.css" rel="stylesheet" />

  <script type="text/javascript">
    function reset(){
      document.getElementById("hovaten").value = '';
      document.getElementById("ngaysinh").value = '';
      document.getElementById("email").value = '';
      document.getElementById("sdt").value = '';
      document.getElementById("pass").value = '';
      document.getElementById("password").value = '';
      document.getElementById("radioNu").value = false;
      document.getElementById("radioNam").value = false;
      location.reload();
    }
  </script>
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
  <br>
  <div class="container">
    <div id="notification"></div>
    <div class="mb-4" style="text-align:center"><h4>ĐĂNG KÝ THÀNH VIÊN</h4></div>
    <!-- FORM INSERT -->
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Họ và tên:</strong></span>
      </div>
      <input type="text" class="form-control" id="hovaten" name="hovaten">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Ngày sinh:</strong></span>
      </div>
      <input type="date" class="form-control" id="ngaysinh" name="ngaysinh">
    </div>
    <div class="form-group ml-2"><strong>Giới tính: </strong>
      <div class="form-check-inline ml-3">
        <label class="form-check-label" for="radioNam">
          <input type="radio" class="form-check-input" id="radioNam" name="gioitinh" value="Nam">Nam
        </label>
      </div>
      <div class="form-check-inline">
        <label class="form-check-label" for="radioNu">
          <input type="radio" class="form-check-input" id="radioNu" name="gioitinh" value="Nữ">Nữ
        </label>
      </div>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Email:</strong></span>
      </div>
      <input type="text" class="form-control" id="email" name="email">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Số điện thoại:</strong></span>
      </div>
      <input type="text" class="form-control" id="sdt" name="sdt" onkeypress="validateNumber(event)" placeholder="Đây là SĐT để liên lạc cho việc học">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Mật khẩu:</strong></span>
      </div>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Passord cho việc đăng nhập">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><strong>Nhập lại mật khẩu:</strong></span>
      </div>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group" style="text-align:center">
      <button class="btn btn-danger" type="submit" onclick="insertTV()">Đăng ký</button>
    </div>
    <!-- END FORM-->
  </div>
  
  <!-- Modal Login -->
  <div class="modal fade" id="login">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Đăng Nhập</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label class="m-0" for="sdt_dn"><h6>Số điện thoại :</h6></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
              </div>
              <input type="text" class="form-control" id="sdt_dn" name="sdt_dn">
            </div>
          </div>
          <div class="form-group">
            <label class="m-0" for="sdt_dn"><h6>Mật khẩu :</h6></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" class="form-control" id="password_dn" name="password_dn" required>
            </div>
          </div>
        <!-- Modal footer -->
        <div class="modal-footer pb-0 m-0">
          <button class="btn-phd" id="dangnhap" name="dangnhap" onclick="login()">Đăng nhập</button>
        </div> 
      </div>
    </div>
  </div>

  <!-- My JavaScript -->
  <script src="js/myScript.js"></script>
</body>
</html>