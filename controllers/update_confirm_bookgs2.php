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
    $user_name = $_SESSION ['username'];

    // Gia su xác nhận lớp học. 

    if (isset($_GET['id'])){
        $id = $_GET['id'];
    }
        // Update Seen = 1;
        $update = "UPDATE thongbao SET Seen = '1' WHERE Id = $id";

        // Thông báo cho thanh vien 
        $tv = "SELECT NguoiGui FROM thongbao WHERE Id = $id";
        $result = $conn->query($tv);
        $nd = "Gia sư đã được đồng ý lời mời dạy học của bạn.";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-m-d");
        foreach ($result as $dt) {
            $insert = "INSERT INTO thongbao (NguoiGui,NguoiNhan,Loai,NoiDung,NgayThongBao,Seen) VALUES ('".$user_name."', '".$dt['NguoiGui']."' ,'1', '".$nd."','".$today."', '0')";
            }
        $check1 = $db->executeNonQuery($update);
        $check2 = $db->executeNonQuery($insert);
        if ($check1 == true && $check2 == true){
            
            echo "<strong>Xác nhận thành công! </br> Bạn hãy liên lạc với người học để bắt đầu nhé!</strong>";
            
         }
         else{
            
            echo "<strong>Xác nhận không thành công! </strong>";
            
        }

?>