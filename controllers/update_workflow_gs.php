<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $linhvuc = $chuyennganh = $hocvi = $noilamviec = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["linhvuc"]) || empty($_GET["chuyennganh"]) || empty($_GET["hocvi"]) || empty($_GET["noilamviec"]))
			$updateOK = false;
		else{
			$sdt = test_input($_GET["sdt"]);
			$linhvuc = test_input($_GET["linhvuc"]);
			$chuyennganh = test_input($_GET["chuyennganh"]);
			$hocvi = test_input($_GET["hocvi"]);
			$noilamviec = test_input($_GET["noilamviec"]);
		}

		if($updateOK == true){
			$sql = "UPDATE giasu SET LinhVuc = '$linhvuc', ChuyenNganh = '$chuyennganh', HocVi = '$hocvi', NoiLamViec = '$noilamviec' WHERE SDT_GS = '$sdt';";

			if($db->executeNonQuery($sql)) echo "1";
			else echo "0";
		}
		else echo "0";
	}

	$db->close();
?>