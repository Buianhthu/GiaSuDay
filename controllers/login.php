<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if(isset($_GET['username']) && isset($_GET['password'])){
		$username = test_input($_GET['username']);
		$password = test_input($_GET['password']);

		$sql = "SELECT * FROM user WHERE Username = '$username' AND Password = '$password'";
		$result = $db->executeQuery($sql);

		if($result){
			$row = mysqli_num_rows($result);
			if($row == 1){
				$temp = $result->fetch_array(MYSQLI_ASSOC);
				$_SESSION['username'] = $temp['Username'];
				$_SESSION['level'] = $temp['Level'];
				$_SESSION['password'] = $temp['Password'];
				$_SESSION['avatar'] = $temp['Avatar'];
				$_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];
				echo 1;
			}
			else echo 0;
		}
		else echo -1;
	
	// -1 : Loi truy xuat data
	// 0 : Loi dang nhap (Tai khoan hoac mat khau khong dung)
	// 1 : Dang nhap thanh cong
	}
	else echo -1;

	$db->close();
?>