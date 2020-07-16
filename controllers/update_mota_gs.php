<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $mota = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["mota"])){
			$updateOK = false;
		}
		else{
			$sdt = test_input($_GET["sdt"]);
			$mota = test_input($_GET["mota"]);
		}

		if(strlen($mota) > 299) $updateOK = false;

		if($updateOK == true){
			$sql = "UPDATE giasu SET MoTa = '$mota' WHERE SDT_GS = '$sdt';";
			
			if($db->executeNonQuery($sql)) echo '1';
			else echo '0';
		}
		else echo '0';
	}

	$db->close();
?>