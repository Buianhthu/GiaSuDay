<?php
session_start(); 
    require_once('./models/data_access_helper.php');
    // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();
    $qr = 'SELECT * FROM TimGiaSu, ThanhVien WHERE TimGiaSu.SDT_TV = ThanhVien.SDT_TV';
    $result = $conn->query($qr);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gia Sư Đây</title>
    <!-- Icon trang web -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/override.css" rel="stylesheet" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head> 
<body>   
<?php
  require_once "views/navigation.php";
?>    

  <h2 class="Tieude"> DANH SÁCH BÀI ĐĂNG <i class="fas fa-book" style="margin-left:10px; font-weight: 50px"></i></h2>
  <div class="Table" id="post">
    <table class="table table-bordered">
            <tr>
                <th>Họ Tên</th>
                <th>Số Điện Thoại</th>
                <th>Tên Môn Học</th>
                <th>Nội Dung</th>
                <th>Thời Gian Học</th>
                <th>Học Phí</th>
                <th>Nhận lớp</th>

            </tr>
        <?php

            if($result->num_rows > 0)
            {
                foreach ($result as $dt){
                    if ($dt['TinhTrang'] == -1)
                    {
                        echo "<tr>";
                        echo "<td>".$dt['HoTen']."</td>";
                        echo "<td>".$dt['SDT_TV']."</td>";
                        echo "<td>".$dt['TenMonHoc']."</td>";
                        echo "<td>".$dt['NoiDung']."</td>";
                        echo "<td>".$dt['ThoiGianHoc']."</td>";
                        echo "<td>".$dt['HocPhi']."</td>";
                        echo "<td><a href='./controllers/update_confirm_post.php?id=".$dt['Id']."' class='button'>Nhận lớp ngay</a></td>";
                         echo "</tr>";
                    }
                    elseif ($dt['TinhTrang'] == 0)
                    {
                        echo "<tr>";
                        echo "<td>".$dt['HoTen']."</td>";
                        echo "<td>".$dt['SDT_TV']."</td>";
                        echo "<td>".$dt['TenMonHoc']."</td>";
                        echo "<td>".$dt['NoiDung']."</td>";
                        echo "<td>".$dt['ThoiGianHoc']."</td>";
                        echo "<td>".$dt['HocPhi']."</td>";
                        echo "<td><a href='./controllers/update_confirm_post.php?id=".$dt['Id']."' class='button'>Chờ xác nhận</a></td>";
                         echo "</tr>";
                    }
                   
              }
            }
          ?>
          
           <script>
              $(document).ready(function(){
                $("a").click(function(){
                    alert('Cảm ơn bạn đã nhận lớp. Mời bạn xác nhận lần nữa');
                    $(this).prop('disabled', true);
                });
              });
            </script>
          
    </table>
        
        
