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

    if ($_SESSION['level'] == 2)
    {
        echo "<div class='container'>";
        echo "<div class='alert alert-danger'>";
        echo "<strong>Bạn đã là gia sư nên không thực hiện được chức năng này!</strong>";
        echo "</div>";
        echo "</div>";
    }
    else {
            if(isset($_GET['id'])){
            $sdt_gs = $_GET['id'];
            }

            //Thông báo cho GS
            $tv = "SELECT SDT_GS FROM giasu WHERE SDT_GS = $sdt_gs";
            $result = $conn->query($tv);
            $nd = "Bạn nhận được lời mời dạy học. Mời bạn xác nhận.";
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("Y-m-d");
            foreach ($result as $dt) {
                $insert = "INSERT INTO ThongBao (NguoiGui,NguoiNhan,Loai,NoiDung,NgayThongBao,Seen) VALUES ('".$user_name."', '".$dt['SDT_GS']."' ,'-1', '".$nd."','".$today."', '0')";
            }
            $check = $db->executeNonQuery($insert);

            if($check == true) {
                echo "<div class='container'>";
                echo "<div class='alert alert-success'>";
                echo "<strong>Bạn đã chọn gia sư thành công! Chờ xác nhận nhé !!!</strong>";
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

            
        }

    $db->close();   
?>
