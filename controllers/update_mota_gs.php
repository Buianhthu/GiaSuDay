<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $mota = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["mota"]))
			$updateOK = false;
		else{
			$username = test_input($_GET["username"]);
			$mota = test_input($_GET["mota"]);
		}

		if(strlen($mota) > 299) $updateOK = false;

		if($updateOK == true){
			$sql = "UPDATE giasu SET MoTa = '$mota' WHERE Username = '$username';";
			
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