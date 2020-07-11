<?php
	session_start();

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();
	$insertOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["monhoc"]) || empty($_GET["chitietmonhoc"]) || empty($_GET["hocphi"]))
			$insertOK = false;
		else{
			$sdt = test_input($_GET["sdt"]);
			$monhoc = test_input($_GET["monhoc"]);
			$chitietmonhoc = test_input($_GET["chitietmonhoc"]);
			$hocphi = test_input($_GET["hocphi"]);
		}

		if( !preg_match("/^[0-9]*$/", $sdt) || !preg_match("/^[0-9]*$/", $hocphi) )
			$insertOK = false;
		if($insertOK == true){
			$sql_check = "SELECT * FROM monday WHERE SDT_GS ='$sdt' AND TenMonHoc ='$monhoc' AND chitietmonhoc ='$chitietmonhoc'";
			$result = $db->executeQuery($sql_check);
			$row = mysqli_num_rows($result);

			if($row > 0){
				echo "-1";
			}
			else{
				$sql = "INSERT INTO monday(SDT_GS, TenMonHoc, ChiTietMonHoc, HocPhi) VALUES('$sdt', '$monhoc', '$chitietmonhoc', '$hocphi')";
				$check = $db->executeNonQuery($sql);
				if($check == true) echo "1";
				else echo "0";
			}
		}
		else echo '0';
	}

	$db->close();
?>