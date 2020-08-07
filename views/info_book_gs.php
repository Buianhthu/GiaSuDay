<?php
  session_start(); 
      require_once('../models/data_access_helper.php');
      // Create an instance of data access helper
      $db = new DataAccessHelper();

      // Connect to database
      $db->connect();
      if (isset($_GET['id'])){
        $id = $_GET['id'];
      }
      $qr = "SELECT * FROM ThongBao,HocVien,User WHERE ThongBao.NguoiGui = HocVien.Username AND HocVien.Username = User.Username AND Id = $id";
      $result = $conn->query($qr);
?>


      <div class="container" style='text-align:center'>
        <h1>THÔNG TIN HỌC VIÊN</h1>
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
      
</body>
</html>
