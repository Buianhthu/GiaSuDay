<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $noidung = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["noidung"]))
			$updateOK = false;
		else{
			$username = test_input($_GET["username"]);
			$noidung = test_input($_GET["noidung"]);
		}

		if(strlen($noidung) > 300) $updateOK = false;

		if($updateOK){
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$date = date("Y-m-d");

			$sql = "UPDATE review SET NoiDung = '$noidung', NgayDang = '$date', KiemDuyet = 0 WHERE Username = '$username';";
			
			if($db->executeNonQuery($sql)) echo 1;
			else echo -2;
		}
		else echo -1;
	}
	else echo -2;

	// -2 : Lỗi xử lý
	// -1 : Lỗi data không hợp lệ
	// 1 : Không có lỗi

	$db->close();
?>