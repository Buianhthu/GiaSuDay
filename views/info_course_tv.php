<?php
session_start(); 
    require_once('../models/data_access_helper.php');
    // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();
?>
   <div class="container" style='text-align:center'>
      <h2>Thông Tin Gia Sư</h2>
    </div>
    <div class="container" style='text-align:center'>
      <ul class="list-group list-group-flush">
        <?php
            if (isset($_GET['id'])){
                $id = $_GET['id'];
                $qr = "SELECT * FROM ThongBao,GiaSu, User WHERE Id = $id AND ThongBao.NguoiGui = GiaSu.Username AND GiaSu.Username = User.Username";
                $result = $conn->query($qr);
                if ($result->num_rows > 0){
                    foreach ($result as $dt) {
                      if ($_SESSION['username'] == $dt['NguoiNhan']){
                        echo "<li class='list-group-item'>Họ Tên: ".$dt['HoTen']."</li>";
                        echo "<li class='list-group-item'>Số Điện Thoại: ".$dt['SDT']."</li>";
                        echo "<li class='list-group-item'>Email: ".$dt['Email']."</li>";
                        echo "<li class='list-group-item'>FaceBook: ".$dt['Facebook']."</li>";
                      }
                    }
                }
            }
            
            
        ?> 
      </ul>
    </div>
  </div>
