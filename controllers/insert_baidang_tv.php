<?php
	session_start();
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Biến thao tác
	$username = $monhoc = $noidung = $hocphi = "";
	$thuhai = $thuba = $thutu = $thunam = $thusau = $thubay = $chunhat = "";
	$numError = 0;
	$message = "";

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["monhoc"]) || empty($_GET["noidung"]) || empty($_GET["hocphi"])){
			$str = '<div class="alert alert-warning alert-dismissible">';
			$str .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			$str .= '<strong>Warning!</strong> Vui lòng nhập đầy đủ các trường cần thiết !</div>';
			die($str);
		}
		else {
			$username = test_input($_GET["username"]);
			$monhoc = test_input($_GET["monhoc"]);
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

		if(!preg_match("/^[0-9]*$/", $hocphi)){
			$numError += 1;
			$message .= "Học phí không hợp lệ./";
		}
		if (strlen($noidung) > 300){
			$numError += 1;
			$message .= "Nội dung không được vượt quá 300 ký tự./";
		}
		if(strlen($monhoc) > 100){
			$numError += 1;
			$message .= "Môn học không được vượt quá 100 ký tự./";
		}

		if($numError > 0) {
			$arr = explode ('/' , $message);
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			for ($i = 0; $i < $numError; $i++) { 
				echo '<strong>Warning!</strong> '. $arr[$i] . '<br>' ;
			}
			echo '</div>';
			die();
		}

		// Create an instance of data access helper
		$db = new DataAccessHelper();

		// Connect to database
		$db->connect();

		// Kiểm tra dữ liệu có bị trùng không
		$sql_check = "SELECT * FROM baidang WHERE Username = '$username' AND MonHoc = '$monhoc'";
		$result = $db->executeQuery($sql_check);
		if(mysqli_num_rows($result) > 0){
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Warning!</strong> Bài đăng về môn học này đã tồn tại.</div>';
			die();
		}

		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date = date("Y-m-d");

		$sql = "INSERT INTO baidang(Username, MonHoc, NoiDung, NgayDang, HocPhi, TinhTrang, KiemDuyet) VALUES('$username','$monhoc','$noidung', '$date','$hocphi', 0, 0)";

		if($db->executeNonQuery($sql)){
			$sql = "SELECT * FROM baidang WHERE Username = '$username' AND MonHoc = '$monhoc'";
			$row = ($db->executeQuery($sql))->fetch_array(MYSQLI_ASSOC);
			$id = $row['Id'];

			$sql = "INSERT INTO thoigianhoc(Id, ThuHai, ThuBa, ThuTu, ThuNam, ThuSau, ThuBay, ChuNhat) VALUES('$id','$thuhai','$thuba', '$thutu','$thunam', '$thusau', '$thubay', '$chunhat')";
			$db->executeNonQuery($sql);

			echo '<div class="alert alert-success alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert" onclick="reset()">&times;</button>';
			echo '<strong>Success!</strong> Đăng thành công, vui lòng đợi thông báo phê duyệt của Admin.';
			echo '</div>';
		}
		else{
			echo '<div class="alert alert-danger alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Fail!</strong> Gặp lỗi trong quá trình xử lý, vui lòng nhập lại.';
			echo '</div>';
		}

		$db->close();
	}

?>