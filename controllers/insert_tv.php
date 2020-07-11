<?php
	session_start();
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$sdt = $_GET["sdt"];
	$email = $_GET["email"];

	// Kiểm tra dữ liệu có bị trùng không
	$sql_check = "SELECT * FROM user WHERE SDT = '" . $sdt . "' OR Email ='" . $email . "'";
	$result = $db->executeQuery($sql_check);
	
	if($result){
		$checkSDT = true;
		$checkEmail = true;
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			if($row['SDT'] == $sdt) $checkSDT = false;
			if($row['Email'] == $email) $checkEmail = false;
		}

		if($checkSDT == false && $checkEmail == false){
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Warning!</strong> Số điện thoại và Email đã tồn tại.';
			echo '</div>';
		}
		else if($checkSDT == false){
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Warning!</strong> Số điện thoại đã tồn tại.';
			echo '</div>';
		}
		else if($checkEmail == false){
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Warning!</strong> Email đã tồn tại.';
			echo '</div>';
		}
		else{
			$hovaten = $_GET["hovaten"];
			$ngaysinh = $_GET["ngaysinh"];
			$gioitinh = $_GET["gioitinh"];
			$password = $_GET["password"];
			$level = 3;

			$sql1 = "INSERT INTO thanhvien(SDT_TV, HoTen ,NgaySinh, GioiTinh) VALUES('$sdt', '$hovaten' ,'$ngaysinh', '$gioitinh')";
			$check1 = $db->executeNonQuery($sql1);

			$sql2 = "INSERT INTO user(SDT, Password, Email, Level, Avatar) VALUES('$sdt', '$password', '$email', '$level', 'img/img_user/user.jpg')";
			$check2 = $db->executeNonQuery($sql2);

			if($check1 == true && $check2 == true) {
				$_SESSION['username'] = $sdt;
				$_SESSION['level'] = $level;
				$_SESSION['password'] = $password;
				$_SESSION['avatar'] = 'img/img_user/user.jpg';
				$_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];
				echo '<div class="alert alert-success alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert" onclick="reset()">&times;</button>';
				echo '<strong>Success!</strong> Đăng ký thành công.';
				echo '</div>';
			}	
			else{
				echo '<div class="alert alert-danger alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Fail!</strong> Đăng ký thất bại.';
				echo '</div>';
			}
		}
	}
	else{
		echo '<div class="alert alert-warning alert-dismissible">';
		echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		echo '<strong>Warning!</strong> Gặp lỗi trong quá trình xử lý, vui lòng đăng ký lại.';
		echo '</div>';
	}

	$db->close();
?>