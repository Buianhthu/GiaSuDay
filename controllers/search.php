<section class="page-section bg-light" id="portfolio">
  <div class="container">
    <div class="text-center">
      <h2 class="section-heading text-uppercase">GIA SƯ CỦA BẠN
        <i class="fas fa-users" style="margin-left:10px"></i>
      </h2>
      <h3 class="section-subheading text-muted">Kiến thức vững vàng - Tương lai tươi sáng</h3>
    </div>
    <div class="row">

<?php
	session_start();
	
	require_once('../models/myFunction.php');
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if ((isset($_GET['khoahoc'])) && (isset($_GET['monhoc']))){
		$khoahoc = $_GET['khoahoc'];
		$monhoc = $_GET['monhoc'];
		$qr =  "SELECT * FROM Monday, Giasu, User WHERE Monday.Username = Giasu.Username AND Giasu.Username = User.Username AND MonHoc LIKE '%$monhoc%'";
		$result = $db->executeQuery($qr);
		if ($result->num_rows > 0){
			foreach ($result as $dt) {
            // if($dt['KiemDuyet'] == 1){
              echo "<div class='col-lg-4 col-sm-6 mb-4'>";
              echo "<div class='portfolio-item'>";

              echo "<a class='portfolio-link' data-toggle='modal' href='#id".$dt['Username']."'>";
              echo "<div class='portfolio-hover'>";
              echo "<div class='portfolio-hover-content'><h1>GSD</h1></div>";
              echo "</div>";
              echo '<div class="avatar_gs" style="background-image:url('."'".$dt["Avatar"]."'".')"></div>';
              echo "</a>";

              echo "<div class='portfolio-caption'>";
              echo "<div class='portfolio-caption-heading'>".$dt['HoTen']."</div>";
              echo "<div class='portfolio-caption-subheading text-muted'>Chuyên ngành: ".$dt['ChuyenNganh']."</div>";
              echo "<div class='portfolio-caption-subheading text-muted'>".$dt['NoiLamViec']."</div>";
              echo "</div>";
              echo "</div>";
              echo "</div>";

              echo "<div class='portfolio-modal modal fade' id='id".$dt['Username']."'>";
		          echo "<div class='modal-dialog'>";
		            echo "<div class='modal-content'>";
		              echo "<div class='close-modal' data-dismiss='modal'><img src='assets/img/close-icon.svg' alt='Close modal' /></div>";
		              echo "<div class='container'>";
		                echo "<div class='row justify-content-center'>";
		                  echo "<div class='col-lg-8'>";
		                    echo "<div class='modal-body'>";
		                      echo "<h2 class='text-uppercase mb-5'>".$dt['HoTen']."</h2>";
		                      echo "<img class='img-fluid d-block mx-auto' src='".$dt['Avatar']."'/>";
		                      echo "<p><i>".$dt['MoTa']."</i></p>";
		                      echo "<ul class='list-inline'>";
		                        echo "<li class='mb-2'><strong>Email : </strong>".$dt['Email']."</li>";
		                        echo "<li class='mb-2'><strong>Lĩnh vực : </strong>".$dt['LinhVuc']."</li>";
		                        echo "<li class='mb-2'><strong>Chuyên ngành : </strong>".$dt['ChuyenNganh']."</li>";
		                        echo "<li class='mb-2'><strong>Nơi làm việc : </strong>".$dt['NoiLamViec']."</li>";
		                      echo "</ul>";

		                      echo '<h4 class="mt-5">Các Môn Dạy</h4>';
		                        $sdt = $dt['Username'];
		                        $sql = "SELECT * FROM monday WHERE Username = '$sdt'";
		                        $kq = $db->executeQuery($sql);

		                        if($kq){
		                          while ($r = $kq->fetch_array(MYSQLI_ASSOC)) {
		                            echo '<ul class="list-group list-group-flush mb-5">';
		                            echo '<li class="list-group-item"><strong>Môn học : </strong>'. $r['MonHoc'] .'</li>';
		                            echo '<li class="list-group-item"><strong>Chi tiết môn học : </strong>'. $r['MonHoc'] .'</li>';
		                            echo '<li class="list-group-item"><strong>Học phí : </strong>'. $r['HocPhi'] .' đồng / 1 buổi</li>';
		                            echo '</ul>';
		                          }
		                        }

		                      echo '<h4 class="mt-5">Thời Gian Dạy</h4>';
		                      echo '<table class="table table-hover table-striped mt-2" style="text-align:center">';
		                        echo '<thead class="thead-dark">';
		                            echo '<tr><th width="10%"></th>';
		                            echo '<th>Thứ hai</th>
		                                  <th>Thứ ba</th>
		                                  <th>Thứ tư</th>
		                                  <th>Thứ năm</th>
		                                  <th>Thứ sáu</th>
		                                  <th>Thứ bảy</th>
		                                  <th>Chủ nhật</th></tr></thead>';
		                        echo '<tbody id="content">';
		                          $sql = "SELECT * FROM thoigianday WHERE Username = '$sdt'";
		                          $kq = $db->executeQuery($sql);

		                          if($kq){
		                            while ($row = $kq->fetch_array(MYSQLI_ASSOC)) {
		                              // Sáng
		                              echo '<tr>';
		                              echo '<td>Sáng</td>';
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
		                              echo '<td>Chiều</td>';
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
		                              echo '<td>Tối</td>';
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
		                        echo '</tbody></table>';
		                      echo '<div><span class="mr-5">Sáng : 8h - 11h</span><span class="mr-5">Chiều : 15h - 18h</span><span class="mr-5">Tối : 18h - 21h</span></div>';
		                      echo "<div id='Id' hidden>".$dt['Username']."</div>";
		                      // echo "<a id='book' href='./controllers/update_confirm_post.php?id=".$dt['SDT_GS']."' class='btn btn-danger mt-5' data-dismiss='modal' type='button'>Đăng ký</a>";
		                      echo "<a data-toggle='modal' data-target='#myModal' class='btn btn-danger mt-5'>Chọn gia sư</a>";
		                    echo "</div>";
		                  echo "</div>";
		                echo "</div>";
		              echo "</div>";
		            echo "</div>";
		          echo "</div>";
		        echo "</div>";
		        
            }
		} 
		else {
			echo "<div class='alert alert-success' style='margin: 0 auto'> ";
  			echo "<strong>Rất Tiếc !</strong> Hiện chưa có gia sư cho môn học này";
			echo "</div>";
		}
	}

$db->close();

?>

		<div class="modal" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">XÁC NHẬN</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      
                      <!-- Modal body -->
                      <div class="modal-body">
                        Mời bạn xác nhận chọn gia sư.
                      </div>
                      
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle='modal' data-target='#myModal2' onclick="book_gs()">Đồng ý</button>
                      </div>
                      
                    </div>
                  </div>
                </div>

                <div class="modal" id="myModal2">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">XÁC NHẬN</h4>
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                      </div>
                      
                      <!-- Modal body -->
                      <div id="modal-body2">
                      </div>
                      
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle='modal' data-target='#myModal2' onclick="book_course()">Đồng ý</button> -->
                      </div>
                      
                    </div>
                  </div>
                </div>