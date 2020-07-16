<?php
session_start(); 
    require_once('../models/data_access_helper.php');
    // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $qr = "SELECT * FROM TimGiaSu,ThanhVien,User WHERE ThanhVien.SDT_TV = User.SDT AND TimGiaSu.SDT_TV = ThanhVien.SDT_TV AND Id = '$id'";
    $result = $conn->query($qr);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thông Tin</title>
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
    <br>
    <br>
    <br>
    <br>

    <div class="container" style='text-align:center'>
      <h2>Thông Tin Học Viên</h2>
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

	<div class="container" style='text-align:center'>
      <h2>Thông Tin Lớp Học</h2>
    </div>
    <div class="container" style='text-align:center'>
      <ul class="list-group list-group-flush">
        <?php
            if ($result->num_rows > 0){
                foreach ($result as $dt) {
                    echo "<li class='list-group-item'>Môn Học: ".$dt['TenMonHoc']."</li>";
                    echo "<li class='list-group-item'>Nội Dung: ".$dt['NoiDung']."</li>";
                    echo "<li class='list-group-item'>Ngày Đăng: ".$dt['NgayDang']."</li>";
                    echo "<li class='list-group-item'>Học Phí: ".$dt['HocPhi']."</li>";
                }
            }
            
        ?> 
      </ul>
    </div>

    

	
