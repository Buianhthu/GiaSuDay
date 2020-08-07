<?php require_once('controllers/check_session.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Gia Sư Đây</title>
  <!-- Icon trang web -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/override.css" rel="stylesheet" />
</head>
<body id="page-top">

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">GSD<i class="fas fa-chalkboard-teacher" style="font-size: 40px; margin-left:5px"></i></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu<i class="fas fa-bars ml-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#baidang">TÌM GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#review">ĐÁNH GIÁ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">LIÊN HỆ</a></li>
        </ul>
        <?php require_once('views/display_login.php'); ?>
      </div>
    </div>
  </nav>

  <!-- Masthead-->
  <header class="masthead">
    <div class="container">
      <div class="masthead-heading text-uppercase tieude">giasuday</div>   

      <!-- Tìm kiếm --> 
      <div class="container">
        <!-- FORM INSERT -->
        <div id='TimGS'>
         <!--  <form action="" method="GET"> -->
            <div class="input-group mb-3" > 
              <div class="input-group-prepend" style="width:80%; margin: 0 auto">
                <span class="input-group-text" style="background-color: #2E9AFE; color:white; width:40%; height: 3rem; text-align: center"><strong>KHOÁ HỌC :</strong></span>
                <select class="form-control" id="khoahoc" name="monhoc" onchange="getCTMH(this)" style="height: 3rem">
                  <option value="">-- Chọn khoá học --</option>
                  <option value="Khoa Học Tự Nhiên">Khoa Học Tự Nhiên</option>
                  <option value="Lập Trình Căn Bản">Lập Trình Căn Bản</option>
                  <option value="Lập Trình Web">Lập Trình Web</option>
                  <option value="Lập Trình Mobile">Lập Trình Mobile</option>
                  <option value="Lập Trình Game">Lập Trình Game</option>
                  <option value="Lập Trình Hệ Thống">Lập Trình Hệ Thống</option>
                  <option value="Tin Học Văn Phòng">Tin Học Văn Phòng</option>
                </select>
                <span class="input-group-text" style="margin-left:20px; background-color: #2E9AFE; color:white; width:40%; height: 3rem; text-align: center"><strong>MÔN HỌC :</strong></span>
                <select class="form-control" id="monhoc" name="chitietmonhoc" style="height: 3rem"></select>
              </div>
            </div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" name="timkiem" href="#portfolio" onclick ="Search()" style="background-color: #fed136; color:white">Tìm Kiếm</a>
            <!-- <a name="timkiem" href="#portfolio" onclick ="Search()" class="btn" style="margin-top: 30px; width:10%; height: 50px; background-color: " >Tìm Kiếm</a> -->
          <!-- </form> -->
        </div>
      </div>
    </div>
  </header>

  <!-- Tìm kiếm -->
   <?php require_once ("timkiemgs.php"); ?>
  
  <!-- Danh sách bài đăng tìm gia sư -->
  <?php require_once ("views/baidang.php"); ?>

  <!-- Danh sách review -->
  <?php require_once ("views/review.php"); ?>

  
  <!-- Liên hệ, Email Marketing -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Contact Us</h2>
      </div>
      <script type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=wGJXc&webforms_id=SLcbs" data-webform-id="SLcbs"></script>
    </div>
  </section>

  <!-- Footer-->
  <footer class="footer py-4" id="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 text-lg-left">Website Made By Group-7 (07/2020)</div>
        <div class="col-lg-4 my-3 my-lg-0">
          <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="col-lg-4 text-lg-right">
          <a class="mr-3" href="#!">Privacy Policy</a>
          <a href="#!">Terms of Use</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Portfolio Modals-->
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
            <label class="m-0" for="sdt_dn"><h6>Tài khoản :</h6></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
              </div>
              <input type="text" class="form-control" id="taikhoan-dn" name="taikhoan-dn">
            </div>
          </div>
          <div class="form-group">
            <label class="m-0" for="sdt_dn"><h6>Mật khẩu :</h6></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" class="form-control" id="matkhau-dn" name="matkhau-dn">
            </div>
          </div>
        <!-- Modal footer -->
        <div class="modal-footer pb-0 m-0">
          <button class="btn-phd" id="btn-dangnhap" name="btn-dangnhap">Đăng nhập</button>
        </div> 
      </div>
    </div>
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
</html>
