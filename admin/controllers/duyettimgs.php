<?php
	require_once('data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Insert data
	$id = $_GET['id']; // id của bài đăng
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$today = date("Y-m-d");

	$tv = "SELECT Username FROM baidang WHERE Id = '$id'";
	$tv1 = $db->executeQuery($tv);
	$tv2 = $tv1->fetch_array(MYSQLI_ASSOC);
	$t = $tv2['Username'];

	$sql = "UPDATE baidang SET KiemDuyet = 1 WHERE Id = '$id';";
	$nd = 'Bài đăng tìm gia sư có Id: '. $id .' của bạn đã được phê duyệt.';
	$sql .= "INSERT INTO thongbao(NguoiGui, NguoiNhan, Loai, NoiDung, NgayThongBao, Seen) VALUES('admin','$t', 0,'$nd','$today',0);";
	
	$check = $db->executeNonMultiQuery($sql);
	
	if($check == true) echo '1';
	else echo '0';

	$db->close();
?>