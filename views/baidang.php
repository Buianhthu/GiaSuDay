<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 <!-- <script src="../js/myScript.js"></script> -->
<?php
  require_once('models/data_access_helper.php');
  // Create an instance of data access helper
  $db = new DataAccessHelper();

  // Connect to database
  $db->connect();

  $item_page2 = !empty($_GET['per_page2'])?$_GET['per_page2']:3;
  $current_page2 = !empty($_GET['page2'])?$_GET['page2']:1;
  $offset2 = ($current_page2 - 1) * $item_page2;
  $result = mysqli_query($conn, "SELECT * FROM BaiDang,HocVien,User WHERE  BaiDang.Username = HocVien.Username AND HocVien.Username = User.UserName LIMIT ".$item_page2." OFFSET ".$offset2."");
  $sum_item2 = mysqli_query($conn, "SELECT * FROM BaiDang,HocVien,User WHERE  BaiDang.Username = HocVien.Username AND HocVien.Username = User.UserName");
  $sum_item2 = $sum_item2 -> num_rows;
  $totalpage2 = ceil ($sum_item2/$item_page2);
?>

 <section class="page-section" id="baidang">
    <div id="notification"></div>
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Tìm Gia Sư<i class="fas fa-user-graduate" style="margin-left:10px"></i></h2>
        <h3 class="section-subheading text-muted"><i class="fas fa-hands-helping" style="margin-right:10px; font-weight: 30px"></i>Chúng tôi cần bạn<i class="fas fa-hands-helping" style="margin-left:10px"></i></h3>
      </div>

      <div class="row text-center">
            <?php
              if($result->num_rows > 0)
              {
                foreach ($result as $dt){
                  if ($dt['TinhTrang'] == -1 && $dt['KiemDuyet'] == 1)
                  {
                        echo "<div class='col-md-4'>";
                        echo "<ul style='list-style:none'>";
                        echo "<li>";
                        echo "<span class='fa-stack fa-4x'>";
                        echo "<i class='fas fa-circle fa-stack-2x text-primary'></i>";
                        echo "<i class='fas fa-graduation-cap fa-stack-1x fa-inverse'></i>";
                        echo "</span>";
                        echo "</li>";
                        // echo "<li hidden id='STT1'>".$dt['Id']."";
                        // echo "</li>";
                        echo "<li>";
                        echo "<h4 id ='Hoten' class='my-3' name='hoten'>".$dt['HoTen']."</h4>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p id ='Sdt' class='text-muted'>"."Số Điện Thoại: ".$dt['SDT']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Tên Môn Học: </br>".$dt['MonHoc']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Học Phí: ".$dt['HocPhi']."</p>";
                        echo "</li>";
                        // echo "<li> <a id='myBtn' href='./controllers/update_confirm_post.php?id=".$dt['Id']."'>Nhận lớp ngay</a></li>";
                        echo "<li> <button class='btn btn-success' data-toggle='modal' data-target='#myModal".$dt['Id']."'>Nhận lớp ngay</button></li>";
                        echo "<li>";
                        echo "<a data-toggle='modal' href='#detail".$dt['Id']."' class='btn btn-danger' style='margin-top:5px; width:45%'>Xem chi tiết</a>";
                        // echo "<a href='views/info_course_gs.php?id=".$dt['Id']."' class='btn btn-danger mt-5'>Xem chi tiết</a>";
                        echo "</li>";
                        echo "</ul>";
                        echo "</div>";
                    }    
                    elseif ($dt['TinhTrang'] == 0)
                    {

                        echo "<div class='col-md-4'>";
                        echo "<ul style='list-style:none'>";
                        echo "<li>";
                        echo "<span class='fa-stack fa-4x'>";
                        echo "<i class='fas fa-circle fa-stack-2x text-primary'></i>";
                        echo "<i class='fas fa-graduation-cap fa-stack-1x fa-inverse'></i>";
                        echo "</span>";
                        echo "</li>";
                        echo "<li>";
                        echo "<h4 class='my-3' name='hoten'>".$dt['HoTen']."</h4>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Số Điện Thoại: ".$dt['SDT']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Tên Môn Học: </br>".$dt['MonHoc']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Học Phí: ".$dt['HocPhi']."</p>";
                        echo "</li>";
                        echo "<li><button class='btn btn-secondary' style='pointer-events: none'>Chờ xác nhận</button></li>";
                        echo "<li>";
                        echo "<a data-toggle='modal' href='#detail".$dt['Id']."' class='btn btn-danger' style='margin-top:5px; width:42%'>Xem chi tiết</a>";
                        echo "</li>";
                        echo "</ul>";            
                        echo "</div>";
                      }     
                    }
                  }
                ?>
              </div>
            </div>

      <?php
        if ($result->num_rows > 0){
          foreach ($result as $dt) {
        echo "<div class='modal fade' id='detail".$dt['Id']."'>";
          echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
              //Modal Header//
              echo "<div class='modal-header'>";
                echo "<button type='button' class='close' data-dismiss='modal'>×</button>";
              echo "</div>";
              //Modal body //
              echo "<div class='modal-body'>";
                echo "<div class='container' style='text-align:center'>";
                  echo "<h4>Thông Tin Học Viên</h2>";
                echo "</div>";
                echo "<div class='container' style='text-align:center'>";
                  echo "<ul class='list-group list-group-flush'>";
                    echo "<li class='list-group-item'>Họ Tên: ".$dt['HoTen']."</li>";
                    echo "<li class='list-group-item'>Số Điện Thoại: ".$dt['SDT']."</li>";
                    echo "<li class='list-group-item'>Email: ".$dt['Email']."</li>";
                    echo "<li class='list-group-item'>FaceBook: ".$dt['Facebook']."</li>";
                  echo "</ul>";
                echo "</div>";
                echo "<div class='container' style='text-align:center'>";
                    echo "<h4>Thông Tin Lớp Học</h2>";
                echo "</div>";
                echo "<div class='container' style='text-align:center'>";
                  echo "<ul class='list-group list-group-flush'>";
                    echo "<li class='list-group-item'>Môn Học: ".$dt['MonHoc']."</li>";
                    echo "<li class='list-group-item'>Nội Dung: ".$dt['NoiDung']."</li>";
                    echo "<li class='list-group-item'>Ngày Đăng: ".$dt['NgayDang']."</li>";
                    echo "<li class='list-group-item'>Học Phí: ".$dt['HocPhi']."</li>";  
                    echo '<h4 class="mt-5">Thời Gian Học</h4>';
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
                      $sql = "SELECT * FROM thoigianhoc WHERE Id =".$dt['Id']."";
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
                  echo "</ul>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            }
          }
        ?>

         <?php
          if ($result){
            foreach ($result as $dt) {
                echo "<div class='modal' id='myModal".$dt['Id']."'>";
                  echo "<div class='modal-dialog'>";
                    echo "<div class='modal-content'>";
                    
                      // <!-- Modal Header -->
                      echo "<div class='modal-header'>";
                        echo "<h4 class='modal-title'>XÁC NHẬN</h4>";
                        echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                      echo "</div>";
                      
                      // <!-- Modal body -->
                      echo "<div class='modal-body'>";
                        echo "Mời bạn xác nhận nhận lớp lần nữa.";
                      echo "</div>";
                      
                      // <!-- Modal footer -->
                      echo "<div class='modal-footer'>";
                        echo "<div id='STT1".$dt['Id']."' hidden >".$dt['Id']."</div>";
                        echo "<button type='button' class='btn btn-danger' data-dismiss='modal' data-toggle='modal' id='".$dt['Id']."' data-target='#myModal2' onclick='book_course(this.id)'>Đồng ý</button>";
                      echo "</div>";
                      
                    echo "</div>";
                  echo "</div>";
                  echo "</div>";
                }
              }
            ?>

            <div class="modal" id="myModal2">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">XÁC NHẬN</h4>
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                      </div>
                      
                      <!-- Modal body -->
                      <div id="modal-body1">
                      </div>
                      
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle='modal' data-target='#myModal2' onclick="book_course()">Đồng ý</button> -->
                      </div>
                      
                    </div>
                  </div>
                </div>

        

              




              <div class="pagination" style="margin:0 auto">
                <?php
                  if ($current_page2 > 1) {
                    $pre_page2 = $current_page2 - 1;
                ?>
                  <a class="current-page" href="?per_page1<?=$item_page1?>&page1=<?=$pre_page1?>&id=#baidang">PRE</a>
                <?php } ?>
                  <?php for ($num=1; $num <= $totalpage2; $num++) { ?>
                  <?php if ($num != $current_page2) { ?>
                  <?php if ($num > $current_page2 - 3 && $num < $current_page2 + 3) { ?>
                  <a class="current-page" href="?per_page2=<?=$item_page2?>&page2=<?=$num?>&id=#baidang"><?=$num?></a>
                <?php } ?>
                <?php } else { ?>
                  <strong class="current-page"><?=$num?></strong>
                <?php } ?>
                  <?php } ?>
                <?php
                  if ($current_page2 < $totalpage2 - 1) {
                $next_page2 = $current_page2 + 1; ?>
                  <a class="current-page" href="?per_page1<?=$item_page1?>&page1=<?=$next_page1?>&id=#baidang">NEXT</a>
                <?php } ?>
              </div>
      
 <?php $db->close(); ?>   

  </section>
  

