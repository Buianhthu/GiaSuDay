<?php
	require_once('../models/data_access_helper.php');
	require_once('../models/myFunction.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if(isset($_GET["id"])){
		$id = test_input($_GET["id"]);
		$sql = "DELETE FROM thoigianhoc WHERE Id = $id;";
		$sql .= "DELETE FROM baidang WHERE Id = $id;";

		if($db->executeNonMultiQuery($sql)) echo 1;
		else echo -2;
	}
	else echo -2;

	// -2 : Lỗi xử lý
	// 1 : Không có lỗi

	$db->close();
?>