<?php
	session_start();
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$sdt = $_GET['username'];
	$password = $_GET['password'];

	// Kiểm tra dữ liệu có bị trùng không
	$sql_check = "SELECT * FROM user WHERE SDT = '" . $sdt . "' AND Password ='" . $password . "'";
	$result = $db->executeQuery($sql_check);

	if($result){
		$row = mysqli_num_rows($result);
		if($row == 1){
			$temp = $result->fetch_array(MYSQLI_ASSOC);
			$_SESSION['username'] = $temp['SDT'];
			$_SESSION['level'] = $temp['Level'];
			$_SESSION['password'] = $temp['Password'];
			$_SESSION['avatar'] = $temp['Avatar'];
			$_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];
			echo '1';
		}
		else{
			echo '0';
		}
	}
	else{
		echo '-1';
	}
	
	// -1 : Loi truy xuat data
	// 0 : Loi dang nhap (Tai khoan hoac mat khau khong dung)
	// 1 : Dang nhap thanh cong

	$db->close();
?>