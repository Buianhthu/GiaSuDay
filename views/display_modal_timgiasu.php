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
			echo '<div class="modal fade" id="id'. $row['Id'] .'">';
    		echo '<div class="modal-dialog">';
      		echo '<div class="modal-content">';
        	echo '<div class="modal-header">';
          	echo '<h4 class="modal-title">Chi tiết nội dung</h4>';
          	echo '<button type="button" class="close" data-dismiss="modal">×</button>';
        	echo '</div>';
        	echo '<div class="modal-body">';
          	echo '<p>'. $row['NoiDung'] .'</p>';
        	echo '</div></div></div></div>';
		}
	}

	$db->close();
?>