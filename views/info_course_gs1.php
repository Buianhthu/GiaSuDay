<?php
session_start(); 
    require_once('../models/data_access_helper.php');
    // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();
    $qr = "SELECT * FROM ThongBao,TimGiaSu,GiaSu,ThanhVien,User WHERE ThongBao.NguoiNhan = TimGiaSu.SDT_TV AND ThongBao.NguoiGui = GiaSu.SDT_GS AND ThanhVien.SDT_TV = User.SDT AND TimGiaSu.SDT_TV = ThanhVien.SDT_TV";
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/styles.css" rel="stylesheet"/>
  <link href="../css/override.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body id="page-top">
    <?php
      require_once ('navigation.php');
    ?>
     <div class="container">
        <a id='home' href='../index.php' class='btn btn-danger mt-5'><i class="fas fa-home"></i>Trang chủ</a></button>
    </div>
	<div class="container">
	  <h2>THÔNG TIN LỚP HỌC & HỌC VIÊN</h2>
	  <table class="table">
	    <thead class="thead-dark">
	      <tr>
	        <th>Họ Tên</th>
	        <th>Số điện thoại</th>
	        <th>Email - FaceBook</th>
	        <th>Môn Học</th>
	        <th>Thời Gian Học</th>
	        <th>Học Phí</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
	      if($result->num_rows > 0){
            foreach ($result as $dt){
                if ($_SESSION['username']==$dt['SDT_GS']){
                    echo "<tr>";
                    echo "<td>".$dt['HoTen']."</td>";
                    echo "<td>".$dt['SDT_TV']."</td>";
                    echo "<td>".$dt['Email']."<br>".$dt['LinkFB']."</td>";
                    echo "<td>".$dt['TenMonHoc']."</td>";
                    echo "<td>".$dt['ThoiGianHoc']."</td>";
                    echo "<td>".$dt['HocPhi']."</td>";
                }  
              }
            }
          ?>
	    </tbody>
	  </table>
	</div>

	