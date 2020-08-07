<?php
	session_start();
	
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$username = $khoahoc = $monhoc = $hocphi = "";
	$insertOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["username"]) || empty($_GET["khoahoc"]) || empty($_GET["monhoc"]) || empty($_GET["hocphi"]))
			$insertOK = false;
		else{
			$username = test_input($_GET["username"]);
			$khoahoc = test_input($_GET["khoahoc"]);
			$monhoc = test_input($_GET["monhoc"]);
			$hocphi = test_input($_GET["hocphi"]);
		}

		if(!preg_match("/^[0-9]*$/", $hocphi))
			$insertOK = false;

		if($insertOK == true){
			$sql_check = "SELECT * FROM monday WHERE Username ='$username' AND KhoaHoc ='$khoahoc' AND MonHoc ='$monhoc'";
			$result = $db->executeQuery($sql_check);

			if(mysqli_num_rows($result)> 0) echo 0;
			else{
				$sql = "INSERT INTO monday(Username, KhoaHoc, MonHoc, HocPhi) VALUES('$username', '$khoahoc', '$monhoc', '$hocphi')";
				if($db->executeNonQuery($sql)) echo 1;
				else echo -2;
			}
		}
		else echo -1;
	}
	else echo -2;

	// -2 : Lỗi xử lý
	// -1 : Lỗi data không hợp lệ
	// 0 : Lỗi data đã tồn tại
	// 1 : Không có lỗi

	$db->close();
?>