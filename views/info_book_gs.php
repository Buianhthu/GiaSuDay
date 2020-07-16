<?php
  session_start(); 
      require_once('../models/data_access_helper.php');
      // Create an instance of data access helper
      $db = new DataAccessHelper();

      // Connect to database
      $db->connect();
      $qr = "SELECT * FROM ThongBao,GiaSu,ThanhVien,User WHERE ThongBao.NguoiNhan = GiaSu.SDT_GS AND ThanhVien.SDT_TV = User.SDT AND ThongBao.NguoiGui = ThanhVien.SDT_TV ";
      $result = $conn->query($qr);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký gia sư</title>
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
  <link href="../css/styles.css" rel="stylesheet"/>
  <link href="../css/override.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body id="page-top">
    <?php
      require_once ('navigation.php');
    ?>
    <br>
    <br>
    <br>
    <br>
      <div class="container" style='text-align:center'>
        <h1>THÔNG TIN HỌC VIÊN</h1>
      </div>
      <div class="container" style='text-align:center'>
        <ul class="list-group list-group-flush">
          <?php
            if ($result->num_rows > 0){
                foreach ($result as $dt) {
                    echo "<li class='list-group-item'>Họ Tên: ".$dt['HoTen']."</li>";
                    echo "<li class='list-group-item'>Số Điện Thoại: ".$dt['SDT_TV']."</li>";
                    echo "<li class='list-group-item'>Email: ".$dt['Email']."</li>";
                    echo "<li class='list-group-item'>FaceBook: ".$dt['LinkFB']."</li>";
                }
            } 
        ?> 
      </ul>
    </div>
      
</body>
</html>
