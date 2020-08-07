<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $fb = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["fb"]))
			$updateOK = false;
		else{
			$username = test_input($_GET["username"]);
			$fb = test_input($_GET["fb"]);
		}

		if( !filter_var($fb, FILTER_VALIDATE_URL) )
			$updateOK = false;

		if($updateOK){
			$sql = "UPDATE user SET Facebook = '$fb' WHERE Username = '$username';";

			if($db->executeNonQuery($sql)) echo 1;
			else echo -2;
		}
		else echo -1;
	}
	else echo -2;

	// -2 : Lỗi xử lý
	// -1 : Lỗi LinkFB không hợp lệ
	// 1 : Không có lỗi

	$db->close();
?>