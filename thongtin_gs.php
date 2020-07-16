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

  if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || !isset($_SESSION['avatar']) || $_SESSION['level'] != 2){
    header("location:index.php");
  }
  require_once('controllers/upload_avatar.php');
  require_once('controllers/upload_chungchi_gs.php');
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
        <?php require_once('views/display_login.php') ?>
      </div>
    </div>
  </nav>
  <!-- END VIEWS -->
  <br>
  <br>
  <br>
  <br>
  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-4">
        <?php
          require_once('views/display_avatar.php');
          require_once('views/display_info_gs.php');
        ?>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-7">
        <div class="row">
          <div class="col">
            <h3 style="text-align:center">Ảnh chứng chỉ</h3>
            <?php require_once('views/display_chungchi_gs.php'); ?>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <?php require_once('views/display_workflow_gs.php'); ?>
            <center><button class="btn-phd btn-phd-sM" data-toggle="modal" href="#updateWorkflow">Thay đổi</button></center>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL LIST -->
  <div class="modal fade" id="updateMoTa">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Giới thiệu bản thân</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-inline">
            <textarea rows="5" cols="150" id="mota" name="mota" maxlength="299" placeholder="Mô tả về kinh nghiệm, ưu điểm của bản thân. Đây là nội dung để thu hút học viên đăng ký."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <?php
            echo '<button class="btn-phd btn-phd-pC" onclick="updateMoTa(';
            echo "'" . $_SESSION['username'] . "'"; 
            echo ')">Cập nhật</button>';
          ?>
        </div>
      </div>
    </div>
  </div>

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

  <div class="modal fade" id="uploadChungchi">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thay đổi ảnh chứng chỉ</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <p class="m-0 p-0" style="text-align:center;"><i>Chứng chỉ có thể là thẻ sinh viên, bằng cấp,...</i></p>
        <form class="ml-5 mr-5 mt-2" action="" method="post" enctype="multipart/form-data">
          <input type="file" class="form-control-file border" name="fileToUpload_CC" id="fileToUpload_CC">
          <div class="modal-footer mt-2">
            <input type="submit" class="btn-phd btn-phd-pC" value="Cập nhật" name="submitCC">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateWorkflow">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thay đổi thông tin chi tiết</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="container mt-3">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Lĩnh vực:</strong></span>
            </div>
            <select class="form-control" id="linhvuc" name="linhvuc" onchange="getChuyenNganh(this)">
              <option value="">-- Chọn lĩnh vực --</option>
              <option value="Sư phạm">Sư phạm</option>
              <option value="Khoa học tự nhiên">Khoa học tự nhiên</option>
              <option value="Công nghệ thông tin">Công nghệ thông tin</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Chuyên ngành:</strong></span>
            </div>
            <select class="form-control" id="chuyennganh" name="chuyennganh"></select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Học vị:</strong></span>
            </div>
            <select class="form-control" id="hocvi" name="hocvi">
              <option value="">-- Chọn học vị --</option>
              <option value="Người lành nghề">Người lành nghề</option>
              <option value="Trung Cấp">Trung Cấp</option>
              <option value="Cao Đẳng">Cao Đẳng</option>
              <option value="Đại Học">Đại Học</option>
              <option value="Thạc Sĩ">Thạc Sĩ</option>
              <option value="Tiến Sĩ">Tiến Sĩ</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Nơi làm việc - công tác:</strong></span>
            </div>
            <input type="text" class="form-control" id="noilamviec" name="noilamviec" placeholder="Tên công ty hoặc tên trường đang theo học và làm việc">
          </div>
        </div>
        <div class="modal-footer">
          <?php
            echo '<button class="btn-phd btn-phd-pC" onclick="updateWorkflow(';
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