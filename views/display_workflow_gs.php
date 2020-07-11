<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || $_SESSION['level'] != 2){
    	header("location:thongtin_gs.php");
  	}

	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$sdt = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM user, giasu WHERE SDT = SDT_GS AND SDT = '" . $sdt . "'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<ul class="list-group list-group-flush mt-4">';
			echo '<li class="list-group-item"><strong>Lĩnh vực : </strong>'. $row['LinhVuc'] .'</li>';
			echo '<li class="list-group-item"><strong>Chuyên ngành : </strong>'. $row['ChuyenNganh'] .'</li>';
			echo '<li class="list-group-item"><strong>Học vị : </strong>'. $row['HocVi'] .'</li>';
			echo '<li class="list-group-item"><strong>Nơi làm việc : </strong>'. $row['NoiLamViec'] .'</li>';
			echo '</ul>';
		}
	}

	$db->close();
?>