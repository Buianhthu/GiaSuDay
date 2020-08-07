<?php
	session_start();
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Biến thao tác
	$id =  $noidung = $hocphi = "";
	$thuhai = $thuba = $thutu = $thunam = $thusau = $thubay = $chunhat = "";

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["id"]) || empty($_GET["noidung"]) || empty($_GET["hocphi"])){
			echo -1;
			die();
		}
		else {
			$id = test_input($_GET["id"]);
			$noidung = test_input($_GET["noidung"]);
			$hocphi = test_input($_GET["hocphi"]);
			$thuhai = isset($_GET["thuhai"]) ? test_input($_GET["thuhai"]) : 0;
			$thuba = isset($_GET["thuba"]) ? test_input($_GET["thuba"]) : 0;
			$thutu = isset($_GET["thutu"]) ? test_input($_GET["thutu"]) : 0;
			$thunam = isset($_GET["thunam"]) ? test_input($_GET["thunam"]) : 0;
			$thusau = isset($_GET["thusau"]) ? test_input($_GET["thusau"]) : 0;
			$thubay = isset($_GET["thubay"]) ? test_input($_GET["thubay"]) : 0;
			$chunhat = isset($_GET["chunhat"]) ? test_input($_GET["chunhat"]) : 0;
		}

		if(!preg_match("/^[0-9]*$/", $hocphi))
			echo -1;
		if (strlen($noidung) > 300)
			echo -1;

		// Create an instance of data access helper
		$db = new DataAccessHelper();

		// Connect to database
		$db->connect();

		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date = date("Y-m-d");

		$sql = "UPDATE baidang SET NoiDung = '$noidung', NgayDang = '$date', HocPhi = '$hocphi' WHERE Id = '$id';";
		if($thuhai + $thuba + $thutu + $thunam + $thusau + $thubay + $chunhat == 0){
			if($db->executeNonQuery($sql)) echo 1;
			else echo -2;
		}
		else{
			$sql .= "UPDATE thoigianhoc SET ThuHai='$thuhai', ThuBa='$thuba', ThuTu='$thutu', ThuNam='$thunam', ThuSau='$thusau', ThuBay='$thubay', ChuNhat='$chunhat' WHERE Id = '$id'";
			if($db->executeNonMultiQuery($sql)) echo 1;
			else echo -2;
		}

		$db->close();
	}
	else echo -2;

?>