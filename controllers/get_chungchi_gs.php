<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || $_SESSION['level'] != 2){
    	header("location:thongtin_gs.php");
  	}

	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$sdt = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM chungchi WHERE SDT_GS = '" . $sdt . "'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo $row['ImageLink'];
		}
	}

	$db->close();
?>