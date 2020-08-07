<?php
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = "";

	if (isset($_GET["sdt"])) {
		$sdt = test_input($_GET["sdt"]);
		$sql = "SELECT * FROM user WHERE SDT = '$sdt'";
		$result = $db->executeQuery($sql);
		if(mysqli_num_rows($result) > 0) echo 0;
		else echo 1;
	}

	$db->close();
?>