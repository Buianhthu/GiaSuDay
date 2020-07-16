<?php
	require_once('data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Insert data
	$id = $_GET['id'];
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$today = date("Y-m-d");
	$tv = "SELECT SDT_TV FROM timgiasu WHERE Id = '$id'";
	$tv1 = $db->executeQuery($tv);
	$tv2 = $tv1->fetch_array(MYSQLI_ASSOC);
	$t = $tv2['SDT_GS'];

	$sql = "UPDATE giasu SET KiemDuyet = '1' WHERE SDT_GS = '$id';";
	$sql .= "INSERT INTO thongbao(NguoiGui, NguoiNhan, Loai, NoiDung, NgayThongBao, Seen) VALUES('admin','$t',1,'Tài khoản của bạn đã được phê duyệt.','$today',0);";
	
	$check = $db->executeNonMultiQuery($sql);
	
	if($check == true) echo '1';
	else echo '0';

	$db->close();
?>