<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level'])){
    	header("location:index.php");
  	}

	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$username = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM thongbao WHERE NguoiNhan = '$username' AND Seen = 0";
	$result = $db->executeQuery($sql);
	$count = mysqli_num_rows($result);
	
	if($count > 0){
		echo '<div class="news">' . $count . '</div>';
	}

	$db->close();
?>