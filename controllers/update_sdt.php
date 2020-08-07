<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $sdt = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["sdt"]))
			$updateOK = false;
		else{
			$username = test_input($_GET["username"]);
			$sdt = test_input($_GET["sdt"]);
		}

		if(!preg_match("/^[0-9]*$/", $sdt))
			$updateOK = false;

		if($updateOK){
			$sql = "SELECT * FROM user WHERE SDT = '$sdt'";
			$result = $db->executeQuery($sql);

			if(mysqli_num_rows($result) > 0) echo 0;
			else{
				$sql = "UPDATE user SET SDT = '$sdt' WHERE Username = '$username';";

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