<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $linhvuc = $chuyennganh = $hocvi = $noilamviec = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]))
			$updateOK = false;
		else{
			$username = test_input($_GET["username"]);
			$linhvuc = test_input($_GET["linhvuc"]);
			$chuyennganh = test_input($_GET["chuyennganh"]);
			$hocvi = test_input($_GET["hocvi"]);
			$noilamviec = test_input($_GET["noilamviec"]);
		}

		if($updateOK == true){
			$sql = "UPDATE giasu SET LinhVuc = '$linhvuc', ChuyenNganh = '$chuyennganh', HocVi = '$hocvi', NoiLamViec = '$noilamviec' WHERE Username = '$username';";

			if($db->executeNonQuery($sql)) echo 1;
			else echo -2;
		}
		else echo -2;
	}
	else echo -2;

	// -2 : Lỗi xử lý
	// 1 : Không có lỗi

	$db->close();
?>