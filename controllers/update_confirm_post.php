<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
<!-- <link href="css/styles.css" rel="stylesheet" />
<link href="css/override.css" rel="stylesheet" /> -->

<?php
session_start(); 
    require_once('../models/data_access_helper.php');
    // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();
    $gs = "SELECT SDT_GS FROM giasu";

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        
    }
    //Update Status
    $update = "UPDATE TimGiaSu SET TinhTrang = '0' WHERE id = $id";

    //Confirm to TV
    $nd = "Gia sư đã nhận bài tìm gia sư của bạn. Bạn hãy xác nhận.";
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date("Y-m-d");
    $tv = "SELECT SDT_TV FROM TimGiaSu WHERE id = $id";
    $den = $db->executeNonQuery($tv);
    $insert = "INSERT INTO ThongBao (NguoiGui,NguoiNhan,Loai,NoiDung,NgayThongBao,Seen) VALUES ('admin', '".$den."','-1', '".$nd."','".$today."', '0')";

    $check = $db->executeNonQuery($update);
    $check2 = $db->executeNonQuery($insert);

    if($check == true) {
        echo "<div class='container'>";
        echo "<div class='alert alert-success'>";
        echo "<strong>Bạn đã nhận lớp thành công!</strong>";
        echo "</div>";
        echo "</div>";
    }
    else{
        echo "<div class='container'>";
        echo "<div class='alert alert-success'>";
        echo "<strong>Nhận lớp không thành công</strong>";
        echo "</div>";
        echo "</div>";
    }

    $db->close();
    
?>

<div id="home" style="margin:0 auto; text-decoration: none">
    <button><a class='home' href="../index.php"><i class="fas fa-home"></i>Trang chủ</a></button>
</div>