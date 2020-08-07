<?php
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if (isset($_GET["username"])) {
		$username = test_input($_GET["username"]);
		$sql = "SELECT * FROM user WHERE Username = '$username'";
		$result = $db->executeQuery($sql);
		if(mysqli_num_rows($result) > 0) echo 0;
		else echo 1;
	}

	$db->close();
?>