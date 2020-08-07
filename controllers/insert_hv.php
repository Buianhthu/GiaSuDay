<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Biến thao tác
	$email = $sdt = $hovaten = $username = $password = $ngaysinh = $gioitinh = "";
	$level = 3; // Biến level mặc định của hocvien
	$avatar = "img/img_user/user.jpg"; // Link avatar mặc định
	$numError = 0;
	$message = "";

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if( empty($_GET["hovaten"]) || empty($_GET["ngaysinh"]) || empty($_GET["gioitinh"]) || empty($_GET["email"]) || empty($_GET["username"]) || empty($_GET["sdt"]) || empty($_GET["password"]) ){
			$str = '<div class="alert alert-warning alert-dismissible">';
			$str .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			$str .= '<strong>Warning!</strong> Không được để trống các trường !</div>';
			die($str);
		}
		else{
			$email = test_input($_GET["email"]);
			$sdt = test_input($_GET["sdt"]);
			$hovaten = test_input($_GET["hovaten"]);
			$username = test_input($_GET["username"]);
			$password = test_input($_GET["password"]);
			$ngaysinh = test_input($_GET["ngaysinh"]);
			$gioitinh = test_input($_GET["gioitinh"]);
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$numError += 1;
			$message .= "Email không hợp lệ./";
		}
		if(!preg_match("/^[0-9]*$/", $sdt)){
			$numError += 1;
			$message .= "Số điện thoại không hợp lệ./";
		}
		if(!check_username($username)){
			$numError += 1;
			$message .= "Tên tài khoản không hợp lệ./";
		}

		if($numError > 0) {
			$arr = explode ('/' , $message);
			for ($i = 0; $i < $numError; $i++) { 
				echo '<div class="alert alert-warning alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Warning!</strong> '. $arr[$i] . '</div>' ;
			}
			die();
		}

		// Create an instance of data access helper
		$db = new DataAccessHelper();

		// Connect to database
		$db->connect();

		// Kiểm tra dữ liệu có bị trùng không
		$sql_check = "SELECT * FROM user WHERE user.Username = '$username' OR SDT = '$sdt' OR Email = '$email'";
		$result = $db->executeQuery($sql_check);
		
		if($result){
			$checkUsername = true;
			$checkEmail = true;
			$checkSDT = true;
			$check = true;

			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				if($row['Username'] == $username) $checkUsername = false;
				if($row['Email'] == $email) $checkEmail = false;
				if($row['SDT'] == $sdt) $checkSDT = false;
			}

			if(!$checkUsername){
				$check = false;
				echo '<div class="alert alert-warning alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Warning!</strong> Tên tài khoản đã tồn tại.</div>';
			}
			if(!$checkEmail){
				$check = false;
				echo '<div class="alert alert-warning alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Warning!</strong> Email đã tồn tại.</div>';
			}
			if(!$checkSDT){
				$check = false;
				echo '<div class="alert alert-warning alert-dismissible">';
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '<strong>Warning!</strong> Số điện thoại đã tồn tại.</div>';
			}

			if($check){
				$sql = "INSERT INTO user(Username, Password, SDT, Email, Level, Avatar) VALUES('$username', '$password', '$sdt', '$email', '$level', '$avatar');";

				$sql .= "INSERT INTO hocvien(Username, HoTen, NgaySinh, GioiTinh) VALUES('$username', '$hovaten' ,'$ngaysinh', '$gioitinh');";

				if($db->executeNonMultiQuery($sql)) {
					$_SESSION['username'] = $username;
					$_SESSION['level'] = $level;
					$_SESSION['password'] = $password;
					$_SESSION['avatar'] = $avatar;
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
			echo '<strong>Warning!</strong> Server gặp lỗi trong quá trình xử lý, vui lòng đăng ký lại.';
			echo '</div>';
		}
		
		$db->close();
	}
?>