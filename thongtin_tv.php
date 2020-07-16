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
  require_once('controllers/upload_avatar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản lý tài khoản</title>
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
      <a class="navbar-brand js-scroll-trigger" href="index.php">GSD<i class="fas fa-chalkboard-teacher" style="font-size: 40px; margin-left:5px"></i><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
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
  <div id="notification"></div>
  <div class="container">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <?php 
          require_once('views/display_avatar.php');
          require_once('views/display_info_tv.php');
        ?>
      </div>
      <div class="col-2"></div>
    </div>
  </div>

  <!-- MODAL LIST -->
  <div class="modal fade" id="updateEmail">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Email</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-envelope"></i></span>
            </div>
            <input type="text" class="form-control" id="email" name="email" placeholder="nguyenvana@gmail.com">
          </div>
        </div>
        <div class="modal-footer">
          <?php
            echo '<button class="btn-phd btn-phd-pC" onclick="updateEmail(';
            echo "'" . $_SESSION['username'] . "'"; 
            echo ')">Cập nhật</button>';
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateFB">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Facebook</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fab fa-facebook"></i></span>
            </div>
            <input type="text" class="form-control" id="fb" name="fb" placeholder="https://www.facebook.com/nguyenvana">
          </div>
        </div>
        <div class="modal-footer">
          <?php
            echo '<button class="btn-phd btn-phd-pC" onclick="updateFB(';
            echo "'" . $_SESSION['username'] . "'"; 
            echo ')">Cập nhật</button>';
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="uploadAvatar">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thay đổi ảnh đại diện</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <form class="ml-5 mr-5 mt-2" action="" method="post" enctype="multipart/form-data">
          <input type="file" class="form-control-file border" name="fileToUpload" id="fileToUpload">
          <div class="modal-footer mt-2">
            <input type="submit" class="btn-phd btn-phd-pC" value="Cập nhật" name="submitAvatar">
          </div>
        </form>
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