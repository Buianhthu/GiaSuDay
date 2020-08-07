<?php
	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$username = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM review WHERE Username = '$username'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<ul class="list-group list-group-flush" style="text-align:center">';
			echo '<li class="list-group-item"><strong>Ngày đăng : </strong>'. $row['NgayDang'] .'</li>';
			echo '<li class="list-group-item"><strong>Nội dung</strong><br>'. $row['NoiDung'];
			echo '<br><button class="btn-phd btn-phd-sM btn-phd-pC mt-2" data-toggle="modal" href="#updateReview">Thay đổi</button></li>';
			if($row['KiemDuyet'] == 0) 
				echo '<li class="list-group-item"><strong>Kiểm duyệt : </strong>Chưa duyệt</li>';
			else echo '<li class="list-group-item"><strong>Kiểm duyệt : </strong>Chưa duyệt</li>';
			echo '</ul>';
		}
	}

	$db->close();
?>