<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || $_SESSION['level'] != 2){
    	header("location:thongtin_gs.php");
  	}

	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$username = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM monday WHERE Username = '$username'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<ul class="list-group list-group-flush mb-3">';
			echo '<li class="list-group-item"><strong>Môn học : </strong>'. $row['KhoaHoc'] .'</li>';
			echo '<li class="list-group-item"><strong>Chi tiết môn học : </strong>'. $row['MonHoc'] .'</li>';
			echo '<li class="list-group-item"><strong>Học phí : </strong>'. $row['HocPhi'] .' đồng</li>';
			echo '<li class="list-group-item"><button class="none" data-id="'.$row['Id']. '" onclick="deleteMonDay(this)"><i class="fas fa-trash"></i></button></li>';
			echo '</ul>';
		}
	}

	$db->close();
?>