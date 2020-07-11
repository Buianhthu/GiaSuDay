<?php
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$id = $_GET["id"];
	$sql = "DELETE FROM monday WHERE Id = $id";

	$check = $db->executeNonQuery($sql);
	if($check == true) echo 1;
	else echo 0;
	
	$db->close();
?>