<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $email = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["email"]))
			$updateOK = false;
		else{
			$username = test_input($_GET["username"]);
			$email = test_input($_GET["email"]);
		}

		if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
			$updateOK = false;

		if($updateOK){
			$sql = "SELECT * FROM user WHERE Email = '$email'";
			$result = $db->executeQuery($sql);

			if(mysqli_num_rows($result) > 0) echo 0;
			else{
				$sql = "UPDATE user SET Email = '$email' WHERE Username = '$username';";

				if($db->executeNonQuery($sql)) echo 1;
				else echo -2;
			}
		}
		else echo -1;
	}
	else echo -2;

	// -2 : Lỗi xử lý
	// -1 : Lỗi Email không hợp lệ
	// 0 : Lỗi Email đã tồn tại
	// 1 : Không có lỗi

	$db->close();
?>