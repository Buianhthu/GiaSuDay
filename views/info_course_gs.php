<?php
session_start(); 
    require_once('../models/data_access_helper.php');
    // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();
    
    $id = $_GET['id'];
    $username = $_SESSION['username'];
    $qr = "SELECT * FROM HocVien,User,ThongBao WHERE Id = $id AND ThongBao.NguoiGui = HocVien.Username AND HocVien.Username = User.Username";
    $result = $conn->query($qr);
    
?>

    <div class="container" style='text-align:center'>
      <h2>Thông Tin Học Viên</h2>
    </div>
    <div class="container" style='text-align:center'>
      <ul class="list-group list-group-flush">
        <?php
            if ($result->num_rows > 0){
                foreach ($result as $dt) {
                    echo "<li class='list-group-item'>Họ Tên: ".$dt['HoTen']."</li>";
                    echo "<li class='list-group-item'>Số Điện Thoại: ".$dt['SDT']."</li>";
                    echo "<li class='list-group-item'>Email: ".$dt['Email']."</li>";
                    echo "<li class='list-group-item'>FaceBook: ".$dt['Facebook']."</li>";
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
                    $sql = "SELECT * FROM BaiDang WHERE Username ='".$dt['Username']."'";
                    $result2 = $db->executeQuery($sql);
                    if ($result2){
                        foreach ($result2 as $ds) {
                            echo "<li class='list-group-item'>Môn Học: ".$ds['MonHoc']."</li>";
                            echo "<li class='list-group-item'>Nội Dung: ".$ds['NoiDung']."</li>";
                            echo "<li class='list-group-item'>Ngày Đăng: ".$ds['NgayDang']."</li>";
                            echo "<li class='list-group-item'>Học Phí: ".$ds['HocPhi']."</li>";
                        }
                    }
                    
                }
            }
            
        ?> 
      </ul>
    </div>

    

    
