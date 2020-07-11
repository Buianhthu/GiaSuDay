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
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["email"]))
			$updateOK = false;
		else{
			$sdt = test_input($_GET["sdt"]);
			$email = test_input($_GET["email"]];
		}

		if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
			$updateOK = false;

		if($updateOK == true){
			$sql = "SELECT * FROM user WHERE Email = '". $email ."'";
			$result = $db->executeQuery($sql);
			$row = mysqli_num_rows($result);

			if($row > 0){
				echo "-1";
			}
			else{
				$sql = "UPDATE user SET Email = '". $email ."' WHERE SDT = '". $sdt . "';";
				$check = $db->executeNonQuery($sql);

				if($check == true) echo "1";
				else echo "0";
			}
		}
		else echo "0";
	}

	$db->close();
?>