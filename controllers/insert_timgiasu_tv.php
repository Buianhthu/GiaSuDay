<?php
	session_start();
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $tenmonhoc = $noidung = $thoigianhoc = $hocphi = "";
	$insertOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["tenmonhoc"]) || empty($_GET["noidung"]) || empty($_GET["thoigianhoc"]) || empty($_GET["hocphi"]))
			$insertOK = false;
		else {
			$sdt = test_input($_GET["sdt"]);
			$tenmonhoc = test_input($_GET["tenmonhoc"]);
			$noidung = test_input($_GET["noidung"]);
			$thoigianhoc = test_input($_GET["thoigianhoc"]);
			$hocphi = test_input($_GET["hocphi"]);
		}

		if( !preg_match("/^[0-9]*$/", $sdt) || !preg_match("/^[0-9]*$/", $hocphi) )
			$insertOK = false;

		if($insertOK == true) {
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$date = date("Y-m-d");

			$sql = "INSERT INTO timgiasu(SDT_TV, TenMonHoc, NoiDung, ThoiGianHoc, NgayDang, HocPhi, TinhTrang, KiemDuyet) VALUES('$sdt','$tenmonhoc','$noidung','$thoigianhoc','$date','$hocphi', 0, 0)";

			if($db->executeNonQuery($sql)){
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
		else{
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Warning!</strong> Có trường nhập không hợp lệ.';
			echo '</div>';
		}
	}

	$db->close();
?>