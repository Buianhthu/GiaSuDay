<?php
	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$sdt = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM timgiasu WHERE SDT_TV = '" . $sdt . "'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<tr>';
			echo '<td>'. $row['Id'] .'</td>';
			echo '<td>'. $row['TenMonHoc'] .'</td>';
			echo '<td><a data-toggle="modal" href="#id'. $row['Id'] .'">Here</a></td>';
			echo '<td>'. $row['ThoiGianHoc'] .'</td>';
			echo '<td>'. $row['HocPhi'] .'</td>';
			echo '<td>'. $row['NgayDang'] .'</td>';

			if($row['TinhTrang'] == 0) echo '<td>Đang tìm</td>';
			else if($row['TinhTrang'] == -1) echo '<td>Đang chờ xác nhận</td>';
			else echo '<td>Đã tìm xong</td>';

			if($row['KiemDuyet'] == 0) echo '<td>Chưa duyệt</td>';
			else echo '<td>Đã duyệt</td>';
			echo '</tr>';
		}
	}

	$db->close();
?>