<?php
    session_start(); 

    require_once('../models/data_access_helper.php');
    // // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();

    $user_name = $_SESSION ['username'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $update1 = "UPDATE thongbao SET Seen = '1' WHERE Id = $id";

        //Update Tinhtrang = 1. Lớp học nhận thành công. 
        $update2 = "UPDATE timgiasu SET TinhTrang = '-1' WHERE Id = $id";

        // Thông báo cho gia sư. 
        $tv = "SELECT NguoiGui FROM thongbao WHERE Id = $id";
        $result = $conn->query($tv);
        $nd = "Lớp học đã bị huỷ";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-m-d");
        foreach ($result as $dt) {
            $insert = "INSERT INTO ThongBao (NguoiGui,NguoiNhan,Loai,NoiDung,NgayThongBao,Seen) VALUES ('admin', '".$dt['NguoiGui']."' ,'1', '".$nd."','".$today."', '0')";
            }

        $check = $db -> executeNonquery($update1);
        if ($check == true){
            echo "<strong>Huỷ thành công!</strong>"; 
        }
        else {
            echo "<strong>Huỷ không thành công! </strong>"; 
        }
    }

?>