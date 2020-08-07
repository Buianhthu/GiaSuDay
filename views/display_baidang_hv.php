<?php
	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$username = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM baidang WHERE Username = '$username'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<tr>';
			echo '<td>'. $row['MonHoc'] .'</td>';
			echo '<td><a data-toggle="modal" href="#nd'. $row['Id'] .'">Xem</a></td>';
			echo '<td>'. $row['HocPhi'] .'</td>';
			echo '<td>'. $row['NgayDang'] .'</td>';

			if($row['TinhTrang'] == 0) echo '<td>Đang tìm</td>';
			else if($row['TinhTrang'] == -1) echo '<td>Đang chờ xác nhận</td>';
			else echo '<td>Đã tìm xong</td>';

			if($row['KiemDuyet'] == 0) echo '<td>Chưa duyệt</td>';
			else echo '<td>Đã duyệt</td>';
			echo '<td>';
			echo '<a class="mr-1 ml-1 icon" data-toggle="modal" href="#update'. $row['Id'] .'"><i class="fas fa-edit"></i></a>';
			echo '<button class="mr-1 ml-1 none" data-id="'.$row['Id']. '" onclick="deleteBaiDang(this)"><i class="fas fa-trash"></i></button></td>';
			echo '</tr>';
		}
	}

	$db->close();
?>