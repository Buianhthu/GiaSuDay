<?php
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function check_username($data){
		if(!preg_match("/^[A-Za-z]*$/", $data[0]))
			return false;
		if (preg_match('/[^A-Za-z0-9]/', $data))
			return false;
		if(strlen($data) < 5 || strlen($data) > 30)
			return false;
		return true;
	}
?>