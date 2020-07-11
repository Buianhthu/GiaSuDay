<?php
	session_start();
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if(isset($_GET["sdt"]) && isset($_GET["thuhai"]) && isset($_GET["thuba"]) && isset($_GET["thutu"]) && isset($_GET["thunam"]) && isset($_GET["thusau"]) && isset($_GET["thubay"]) && isset($_GET["chunhat"]) ){
		$sdt = $_GET["sdt"];
		$thuhai = $_GET["thuhai"];
		$thuba = $_GET["thuba"];
		$thutu = $_GET["thutu"];
		$thunam = $_GET["thunam"];
		$thusau = $_GET["thusau"];
		$thubay = $_GET["thubay"];
		$chunhat = $_GET["chunhat"];

		$sql = "UPDATE thoigianday SET ThuHai ='". $thuhai ."', ThuBa ='". $thuba ."', ThuTu ='". $thutu ."', ThuNam ='". $thunam ."', ThuSau ='". $thusau ."', ThuBay ='". $thubay ."', ChuNhat ='". $chunhat ."' WHERE SDT_GS ='". $sdt . "';";
		$check = $db->executeNonQuery($sql);

		if($check == true) echo "1";
		else echo "0";
	}

	$db->close();
?>