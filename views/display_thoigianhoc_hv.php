<table class="table table-hover table-responsive mt-2" style="text-align:center;">
  <thead class="thead-dark" style="width:auto">
    <tr>
      <th style="width:9%"></th>
      <th style="width:13%">Thứ 2</th>
      <th style="width:13%">Thứ 3</th>
      <th style="width:13%">Thứ 4</th>
      <th style="width:13%">Thứ 5</th>
      <th style="width:13%">Thứ 6</th>
      <th style="width:13%">Thứ 7</th>
      <th style="width:13%">Chủ Nhật</th>
    </tr>
  </thead>
  <tbody id="content">
    
<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || $_SESSION['level'] != 3){
    	header("location:index.php");
  	}

	// Lấy dữ liệu
	$sql1 = "SELECT * FROM thoigianhoc WHERE Id = '" . $row['Id'] . "'";
	$result1 = $db->executeQuery($sql1);
	
	if($result1){
		while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
			// Sáng
			echo '<tr>';
			echo '<td>Sáng</td>';
			if(strpos($row1['ThuHai'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuBa'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuTu'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuNam'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuSau'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuBay'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ChuNhat'], '1') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			echo '</tr>';

			// Chiều
			echo '<tr>';
			echo '<td>Chiều</td>';
			if(strpos($row1['ThuHai'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuBa'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuTu'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuNam'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuSau'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuBay'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ChuNhat'], '2') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			echo '</tr>';

			// Tối
			echo '<tr>';
			echo '<td>Tối</td>';
			if(strpos($row1['ThuHai'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuBa'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuTu'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuNam'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuSau'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ThuBay'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			if(strpos($row1['ChuNhat'], '3') !== false){
				echo '<td><i class="far fa-check-circle"></i></td>';
			}
			else echo '<td></td>';
			echo '</tr>';
		}
	}

?>

  </tbody>
</table>