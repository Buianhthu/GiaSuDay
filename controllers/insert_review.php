<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $noidung = "";
	$insertOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["noidung"]))
			$insertOK = false;
		else{
			$username = test_input($_GET["username"]);
			$noidung = test_input($_GET["noidung"]);
		}

		if(strlen($noidung) > 300) $insertOK = false;

		if($insertOK){
			$sql_check = "SELECT * FROM review WHERE Username = '$username'";
			$result = $db->executeQuery($sql_check);
			if(mysqli_num_rows($result) > 0){
				echo '<div class="alert alert-warning alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Warning!</strong> Mỗi Học viên chỉ được đăng duy nhất một lần, vui lòng xem lại review của bạn ở mục Review của tôi !';
				echo '</div>';
				die();
			}

			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$date = date("Y-m-d");

			$sql = "INSERT INTO review(Username, NoiDung, NgayDang, KiemDuyet) VALUES('$username', '$noidung', '$date', 0)";
			if($db->executeNonQuery($sql)) {
				echo '<div class="alert alert-success alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert" onclick="reset()">&times;</button>';
				echo '<strong>Success!</strong> Đăng thành công, vui lòng đợi thông báo phê duyệt của Admin.';
				echo '</div>';
			}
			else{
				echo '<div class="alert alert-warning alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Warning!</strong> SERVER gặp lỗi trong quá trình xử lý, vui lòng nhập lại !';
				echo '</div>';
			}
		}
		else {
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Warning!</strong> Nội dung không hợp lệ !';
			echo '</div>';
		}
	}
	else {
		echo '<div class="alert alert-warning alert-dismissible">';
		echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		echo '<strong>Warning!</strong> SERVER gặp lỗi trong quá trình xử lý, vui lòng nhập lại !';
		echo '</div>';
	}

	$db->close();
?>