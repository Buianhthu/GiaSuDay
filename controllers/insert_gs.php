<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$email = $sdt = $cmnd = $hovaten = $password = $ngaysinh = $gioitinh = "";
	$level = 2; // Biến mặc định
	$insertOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if( empty($_GET["hovaten"]) || empty($_GET["ngaysinh"]) || empty($_GET["gioitinh"]) || empty($_GET["email"]) || empty($_GET["sdt"]) || empty($_GET["cmnd"]) || empty($_GET["password"]) )
			$insertOK = false;
		else{
			$email = test_input($_GET["email"]);
			$sdt = test_input($_GET["sdt"]);
			$cmnd = test_input($_GET["cmnd"]);
			$hovaten = test_input($_GET["hovaten"]);
			$password = test_input($_GET["password"]);
			$ngaysinh = test_input($_GET["ngaysinh"]);
			$gioitinh = test_input($_GET["gioitinh"]);
		}

		if( !preg_match("/^[0-9]*$/", $sdt) || !preg_match("/^[0-9]*$/", $cmnd) )
			$insertOK = false;
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
			$insertOK = false;

		if($insertOK == true) {
			// Kiểm tra dữ liệu có bị trùng không
			$sql_check = "SELECT * FROM user WHERE SDT = '$sdt' OR Email = '$email'";
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
					$sql = "INSERT INTO giasu(SDT_GS, HoTen ,NgaySinh, GioiTinh, CMND, KiemDuyet) VALUES('$sdt', '$hovaten' ,'$ngaysinh', '$gioitinh', '$cmnd', 0);";

					$sql .= "INSERT INTO user(SDT, Password, Email, Level, Avatar) VALUES('$sdt', '$password', '$email', '$level', 'img/img_user/user.jpg');";

					// Insert dữ liệu tạm cho những bảng liên quan 
					$sql .= "INSERT INTO chungchi(SDT_GS, ImageLink) VALUES('$sdt', 'img/img_cc/nothing.png');";

					$sql .= "INSERT INTO thoigianday(SDT_GS, ThuHai, ThuBa, ThuTu, ThuNam, ThuSau, ThuBay, ChuNhat) VALUES('$sdt', '0', '0', '0', '0', '0', '0', '0')";

					if($db->executeNonMultiQuery($sql) == true) {
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
		}
		else{
			echo '<div class="alert alert-warning alert-dismissible">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Warning!</strong> Có trường nhập không hợp lệ, vui lòng kiểm tra lại.';
			echo '</div>';
		}
	}

	$db->close();
?>