<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $thuhai = $thuba = $thutu = $thunam = $thusau = $thubay = $chunhat = "";
	$updateOK = true;

	if($_SERVER["REQUEST_METHOD"] == "GET"){
		if(empty($_GET["sdt"]))
			$updateOK = false;
		else{
			$sdt = test_input($_GET["sdt"]);
			$thuhai = test_input($_GET["thuhai"]);
			$thuba = test_input($_GET["thuba"]);
			$thutu = test_input($_GET["thutu"]);
			$thunam = test_input($_GET["thunam"]);
			$thusau = test_input($_GET["thusau"]);
			$thubay = test_input($_GET["thubay"]);
			$chunhat = test_input($_GET["chunhat"]);
		}

		if($updateOK == true){
			$sql = "UPDATE thoigianday SET ThuHai ='$thuhai', ThuBa ='$thuba', ThuTu ='$thutu', ThuNam ='$thunam', ThuSau ='$thusau', ThuBay ='$thubay', ChuNhat ='$chunhat' WHERE SDT_GS ='$sdt';";

			if($db->executeNonQuery($sql)) echo "1";
			else echo "0";
		}
		else echo "0";
	}

	$db->close();
?>