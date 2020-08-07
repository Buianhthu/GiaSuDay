<?php
	require_once('data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Insert data
	$username = $_GET['username'];
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$today = date("Y-m-d");

	$sql = "UPDATE giasu SET KiemDuyet = 1 WHERE Username = '$username';";
	$sql .= "INSERT INTO thongbao(NguoiGui, NguoiNhan, Loai, NoiDung, NgayThongBao, Seen) VALUES('admin','$username', 0,'Tài khoản của bạn đã được phê duyệt.','$today',0);";
	
	$check = $db->executeNonMultiQuery($sql);
	
	if($check == true) echo '1';
	else echo '0';

	$db->close();
?>