<?php
	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$sdt = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM review WHERE SDT_TV = '" . $sdt . "'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<tr>';
			echo '<td>'. $row['Id'] .'</td>';
			echo '<td>'. $row['NoiDung'] .'</td>';
			echo '<td>'. $row['NgayDang'] .'</td>';

			if($row['KiemDuyet'] == 0) echo '<td>Chưa duyệt</td>';
			else echo '<td>Đã duyệt</td>';
			echo '</tr>';
		}
	}

	$db->close();
?>