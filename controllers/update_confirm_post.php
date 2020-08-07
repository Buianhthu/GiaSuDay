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

    $user_name = $_SESSION ['username'];

    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 3)
    {
        // echo "<div class='container'>";
        // echo "<div class='alert alert-danger'>";
        echo "<strong>Xin lỗi bạn không phải là gia sư nên không thể nhận lớp!</strong>";
        // echo "</div>";
        // echo "</div>";
    }
    else {
            if(isset($_GET['id'])){
            $id = $_GET['id'];
            }
            //Update Status Từ -1 -> 0.
             $update = "UPDATE BaiDang SET TinhTrang = '0' WHERE Id = $id";

            //Thông báo cho TV
            $tv = "SELECT Username FROM baidang WHERE Id = $id";
            $result = $conn->query($tv);
            $nd = "Gia sư đã nhận bài tìm gia sư của bạn. Bạn hãy xác nhận.";
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("Y-m-d");
            foreach ($result as $dt) {
                $insert = "INSERT INTO ThongBao (NguoiGui,NguoiNhan,Loai,NoiDung,NgayThongBao,Seen) VALUES ('".$user_name."', '".$dt['Username']."' ,'-1', '".$nd."','".$today."', '0')";
            }
            $check = $db -> executeNonQuery ($update);
            $check2 = $db->executeNonQuery($insert);

            if($check == true) {
                // echo "<div class='container'>";
                // echo "<div class='alert alert-success'>";
                echo "<strong>Bạn đã nhận lớp thành công!</strong>";
                // echo "</div>";
                // echo "</div>";
            }
            else{
                // echo "<div class='container'>";
                // echo "<div class='alert alert-success'>";
                echo "<strong>Nhận lớp không thành công</strong>";
                // echo "</div>";
                // echo "</div>";
            }

            
        }


    $db->close();

    
?>
