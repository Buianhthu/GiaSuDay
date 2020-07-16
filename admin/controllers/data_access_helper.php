<?php

class DataAccessHelper {
	private $conn;

	public function connect(){
		$servername = "localhost:3306";
		$username = "root";
		$password = "";
		$dbname = "giasuday";

		// Create connection
		$GLOBALS['conn'] = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($GLOBALS['conn']->connect_error) {
			die("Connection failed: " .$GLOBALS['conn']->connect_error);
		}
	}

	public function executeNonQuery($sql){
		if ($GLOBALS['conn']->query($sql) === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function executeNonMultiQuery($sql){
		if ($GLOBALS['conn']->multi_query($sql) === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function executeQuery($sql){
		$result = $GLOBALS['conn']->query($sql);
		return $result;
	}

	public function close(){
		mysqli_close($GLOBALS['conn']);
	}
}

?> 