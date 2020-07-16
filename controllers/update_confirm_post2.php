<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

<?php
    session_start(); 

    require_once('../models/data_access_helper.php');
    // // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();

    // Thành viên xác nhận lớp học. 
    if(isset($_GET['xn'])){
        $xn = $_GET['xn'];
        // Update Seen = 1;
        $update1 = "UPDATE thongbao SET Seen = '1' WHERE NguoiNhan = $xn";

        //Update Tinhtrang = 1. Lớp học nhận thành công. 
        $update2 = "UPDATE timgiasu SET TinhTrang = '1' WHERE SDT_TV = $xn";

        // Thông báo cho gia sư. 
        $tv = "SELECT NguoiGui FROM thongbao WHERE NguoiNhan = $xn";
        $result = $conn->query($tv);
        $nd = "Lớp học ".$xn." đã được xác nhận thành công.";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-m-d H-m-s");
        foreach ($result as $dt) {
            $insert = "INSERT INTO thongbao (NguoiGui,NguoiNhan,Loai,NoiDung,NgayThongBao,Seen) VALUES ('admin', '".$dt['NguoiGui']."' ,'1', '".$nd."','".$today."', '0')";
            }

        $check1 = $db->executeNonQuery($update1);
        $check2 = $db->executeNonQuery($update2);
        $check3 = $db->executeNonQuery($insert);
        if ($check1 == true && $check2 == true){
            echo "<div class='container'>";
            echo "<div class='alert alert-success'>";
            echo "<strong>Xác nhận thành công! </br> Bạn hãy liên lạc với gia sư để học nhé! </br> Chúc bạn đạt kết quả như mong muốn!.</strong>";
            echo "</div>";
            echo "</div>";
         }
         else{
            echo "<div class='container'>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>Xác nhận không thành công! </strong>";
            echo "</div>";
            echo "</div>";
        }
        
    }
    // Thành viên huỷ lớp học
    elseif (isset($_GET['huy'])) {
        $huy = $_GET['huy'];

        //Update TinhTrang = -1. Lớp học không được nhận.
        $update = "UPDATE timgiasu SET Tinhtrang='-1' WHERE SDT_TV = $xn";

        //Update Seen = 1;
        $update1 = "UPDATE thongbao SET Seen = '1' WHERE NguoiNhan = $xn";

        // Thông báo cho gia sư. 
        $tv = "SELECT NguoiGui FROM thongbao WHERE NguoiNhan = $xn";
        $result = $conn->query($tv);
        $nd = "Lớp học".$xn."không được xác nhận.";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-m-d");
        foreach ($result as $dt) {
            $insert = "INSERT INTO ThongBao (NguoiGui,NguoiNhan,Loai,NoiDung,NgayThongBao,Seen) VALUES ('admin', '".$dt['NguoiGui']."' ,'1', '".$nd."','".$today."', '0')";
            }

        $check = $db -> executeNonquery($update);
        if ($check == true){
            echo "<div class='container'>";
            echo "<div class='alert alert-success'>";
            echo "<strong>Huỷ thành công!</strong>";
            echo "</div>";
            echo "</div>";
        }
        else {
            echo "<div class='container'>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>Huỷ không thành công! </strong>";
            echo "</div>";
            echo "</div>";
        }
    }

?>