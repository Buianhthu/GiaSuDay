<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || $_SESSION['level'] != 2){
    	header("location:index.php");
  	}

	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$username = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM thoigianday WHERE Username = '$username'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			// Sáng
			echo '<tr>';
			echo '<td>Sáng (8h - 11h)</td>';
			if(strpos($row['ThuHai'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuBa'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuTu'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuNam'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuSau'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuBay'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ChuNhat'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			echo '</tr>';

			// Chiều
			echo '<tr>';
			echo '<td>Chiều (15h - 18h)</td>';
			if(strpos($row['ThuHai'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuBa'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuTu'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuNam'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuSau'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuBay'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ChuNhat'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			echo '</tr>';

			// Tối
			echo '<tr>';
			echo '<td>Tối (18h - 21h)</td>';
			if(strpos($row['ThuHai'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuBa'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuTu'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuNam'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuSau'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ThuBay'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row['ChuNhat'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			echo '</tr>';
		}
	}

	$db->close();
?>