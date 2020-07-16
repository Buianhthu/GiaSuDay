<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $fb = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["fb"]))
			$updateOK = false;
		else{
			$sdt = test_input($_GET["sdt"]);
			$fb = test_input($_GET["fb"]);
		}

		if( !filter_var($fb, FILTER_VALIDATE_URL) )
			$updateOK = false;

		if($updateOK == true){
			$sql = "UPDATE user SET LinkFB = '$fb' WHERE SDT = '$sdt';";

			if($db->executeNonQuery($sql)) echo "1";
			else echo "0";
		}
		else echo "0";
	}

	$db->close();
?>