<?php
	session_start();
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if( isset($_GET["sdt"]) && isset($_GET["tenmonhoc"]) && isset($_GET["noidung"]) && isset($_GET["thoigianhoc"]) && isset($_GET["hocphi"]) ){
		$sdt = $_GET["sdt"];
		$tenmonhoc = $_GET["tenmonhoc"];
		$noidung = $_GET["noidung"];
		$thoigianhoc = $_GET["thoigianhoc"];
		$hocphi = $_GET["hocphi"];

		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date = date("Y-m-d");

		$sql = "INSERT INTO timgiasu(SDT_TV, TenMonHoc, NoiDung, ThoiGianHoc, NgayDang, HocPhi, TinhTrang, KiemDuyet) VALUES('$sdt','$tenmonhoc','$noidung','$thoigianhoc','$date','hocphi', 0, 0)";
		$check = $db->executeNonQuery($sql);

		if($check == true){
			echo '<div class="alert alert-success alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert" onclick="reset()">&times;</button>';
			echo '<strong>Success!</strong> Đăng thành công, vui lòng đợi thông báo phê duyệt của Admin.';
			echo '</div>';
		}
		else{
			echo '<div class="alert alert-danger alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Fail!</strong> Gặp lỗi trong quá trình xử lý, vui lòng đăng lại.';
			echo '</div>';
		}
	}

	$db->close();
?>