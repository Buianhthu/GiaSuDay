<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || $_SESSION['level'] != 3){
    	header("location:index.php");
  	}

	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$username = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM user, hocvien WHERE user.Username = hocvien.Username AND user.Username = '$username'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<ul class="list-group list-group-flush mt-3 mb-3" style="text-align:center">';
			echo '<li class="list-group-item"><strong>Họ và tên : </strong>'. $row['HoTen'] .'</li>';
			echo '<li class="list-group-item"><strong>Ngày sinh : </strong>'. $row['NgaySinh'] .'</li>';
			echo '<li class="list-group-item"><strong>Giới tính : </strong>'. $row['GioiTinh'] .'</li>';
			echo '<li class="list-group-item"><strong>Số điện thoại : </strong>'. $row['SDT'];
			echo '<br><button class="btn-phd btn-phd-sM btn-phd-pC mt-2" data-toggle="modal" href="#updateSDT">Thay đổi</button></li>';
			echo '<li class="list-group-item"><strong>Hiện tại là : </strong>'. $row['CongViec'];
			echo '<br><button class="btn-phd btn-phd-sM btn-phd-pC mt-2" data-toggle="modal" href="#updateCongViec">Thay đổi</button></li>';
			echo '<li class="list-group-item"><strong>Email : </strong>'. $row['Email'];
			echo '<br><button class="btn-phd btn-phd-sM btn-phd-pC mt-2" data-toggle="modal" href="#updateEmail">Thay đổi</button></li>';
			echo '<li class="list-group-item" style="overflow:hidden"><strong>Link Facebook : </strong><a href="'. $row['Facebook'] .'" target="_blank"> '. $row['Facebook'] .'</a>';
			echo '<br><button class="btn-phd btn-phd-sM btn-phd-pC mt-2" data-toggle="modal" href="#updateFB">Thay đổi</button></li>';
			
			echo '</ul>';
		}
	}

	$db->close();
?>