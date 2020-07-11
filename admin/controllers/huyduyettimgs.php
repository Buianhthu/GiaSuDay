<?php
	require_once('data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	// Insert data
	$id = $_GET['id'];
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$today = date("Y-m-d");
	$tv = "SELECT SDT_TV FROM timgiasu WHERE Id = '$id'";
	$tv1 = $db->executeQuery($tv);
	$tv2 = $tv1->fetch_array(MYSQLI_ASSOC);
	$t = $tv2['SDT_TV'];

	$sql = "UPDATE timgiasu SET KIEMDUYET = '0' WHERE Id = '$id'";
	$sql2 = "INSERT INTO thongbao(NguoiGui, NguoiNhan, Loai, NoiDung, NgayThongBao, Seen) VALUES('admin','$t',1,'Tài khoản chưa được phê duyệt','$today',0);";
	
	$check = $db->executeNonQuery($sql);
	$check2 = $db->executeNonQuery($sql2);
	
	if($check == true && $check2 == true) {
		echo '<div class="alert alert-success alert-dismissible">';
		echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		echo '<strong>Success!</strong> hủy duyệt thành công. Vui lòng F5 để xem kết quả';
		echo '</div>';
	}
	else{
		echo '<div class="alert alert-danger alert-dismissible">';
		echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		echo '<strong>Fail!</strong> hủy duyệt thất bại.';
		echo '</div>';
	}

	$db->close();
?>