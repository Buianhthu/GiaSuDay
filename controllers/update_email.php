<?php
	session_start();

	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Biến thao tác
	$sdt = $email = "";
	$updateOK = true;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if(empty($_GET["sdt"]) || empty($_GET["email"]))
			$updateOK = false;
		else{
			$sdt = test_input($_GET["sdt"]);
			$email = test_input($_GET["email"]);
		}

		if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
			$updateOK = false;

		if($updateOK == true){
			$sql = "SELECT * FROM user WHERE Email = '$email'";
			$result = $db->executeQuery($sql);

			if(mysqli_num_rows($result) > 0){
				echo "-1";
			}
			else{
				$sql = "UPDATE user SET Email = '$email' WHERE SDT = '$sdt';";

				if($db->executeNonQuery($sql)) echo "1";
				else echo "0";
			}
		}
		else echo "0";
	}

	$db->close();
?>