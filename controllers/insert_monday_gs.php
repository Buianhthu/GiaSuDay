<?php
	session_start();
	
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $monhoc = $chitietmonhoc = $hocphi = "";
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

		if(!preg_match("/^[0-9]*$/", $hocphi))
			$insertOK = false;

		if($insertOK == true){
			$sql_check = "SELECT * FROM monday WHERE SDT_GS ='$sdt' AND TenMonHoc ='$monhoc' AND chitietmonhoc ='$chitietmonhoc'";
			$result = $db->executeQuery($sql_check);

			if(mysqli_num_rows($result)> 0){
				echo "-1";
			}
			else{
				$sql = "INSERT INTO monday(SDT_GS, TenMonHoc, ChiTietMonHoc, HocPhi) VALUES('$sdt', '$monhoc', '$chitietmonhoc', '$hocphi')";
				if($db->executeNonQuery($sql)) echo "1";
				else echo "0";
			}
		}
		else echo '0';
	}

	$db->close();
?>