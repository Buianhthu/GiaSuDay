<?php
	session_start();
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if( isset($_GET["sdt"]) && isset($_GET["linhvuc"]) && isset($_GET["chuyennganh"]) && isset($_GET["hocvi"]) && isset($_GET["noilamviec"]) ){
		$sdt = $_GET["sdt"];
		$linhvuc = $_GET["linhvuc"];
		$chuyennganh = $_GET["chuyennganh"];
		$hocvi = $_GET["hocvi"];
		$noilamviec = $_GET["noilamviec"];

		$sql = "UPDATE giasu SET LinhVuc = '". $linhvuc . "', ChuyenNganh = '". $chuyennganh ."', HocVi = '". $hocvi ."', NoiLamViec ='". $noilamviec ."' WHERE SDT_GS = '". $sdt . "';";
		$check = $db->executeNonQuery($sql);

		if($check == true) echo "1";
		else echo "0";
	}

	$db->close();
?>