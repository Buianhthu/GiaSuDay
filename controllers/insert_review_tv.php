<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $noidung = "";
	$insertOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["noidung"]))
			$insertOK = false;
		else{
			$sdt = test_input($_GET["sdt"]);
			$noidung = test_input($_GET["noidung"]);
		}

		if(strlen($noidung) > 299) $insertOK = false;

		if($insertOK == true){
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$date = date("Y-m-d");

			$sql = "INSERT INTO review(SDT_TV, NoiDung, NgayDang, KiemDuyet) VALUES('$sdt', '$noidung', '$date', 0)";
			if($db->executeNonQuery($sql)) {
				echo '<div class="alert alert-success alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert" onclick="reset()">&times;</button>';
				echo '<strong>Success!</strong> Đăng thành công, vui lòng đợi thông báo phê duyệt của Admin.';
				echo '</div>';
			}
			else{
				echo '<div class="alert alert-danger alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Fail!</strong> Đăng thất bại !';
				echo '</div>';
			}
		}
		else {
			echo '<div class="alert alert-danger alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Fail!</strong> Đăng thất bại !';
			echo '</div>';
		}
	}

	$db->close();
?>