<?php
  require_once('./models/data_access_helper.php');
  $db = new DataAccessHelper();

  // Connect to database
  $db->connect();
  // $qr = 'SELECT * FROM GiaSu INNER JOIN User WHERE GiaSu.SDT_GS = User.SDT';
  // $result = $conn->query($qr);

  $item_page1 = !empty($_GET['per_page1'])?$_GET['per_page1']:6;
  $current_page1 = !empty($_GET['page1'])?$_GET['page1']:1;
  $offset1 = ($current_page1 - 1) * $item_page1;

  $result = mysqli_query($conn, "SELECT * FROM GiaSu INNER JOIN User WHERE GiaSu.SDT_GS = User.SDT LIMIT ".$item_page1." OFFSET ".$offset1."");

  $sum_item1 = mysqli_query($conn, "SELECT * FROM GiaSu INNER JOIN User WHERE GiaSu.SDT_GS = User.SDT");
  $sum_item1 = $sum_item1 -> num_rows;
  $totalpage1 = ceil ($sum_item1/$item_page1);
?>


<section class="page-section bg-light" id="portfolio">
  <div class="container">
    <div class="text-center">
      <h2 class="section-heading text-uppercase">ĐỘI NGŨ GIA SƯ
        <i class="fas fa-users" style="margin-left:10px"></i>
      </h2>
      <h3 class="section-subheading text-muted">Kiến thức vững vàng - Tương lai tươi sáng</h3>
    </div>
    <div class="row">
      <?php  
        if($result->num_rows > 0)
        {
          foreach ($result as $dt){
            //if($dt['KiemDuyet'] == 1)
            //{
              echo "<div class='col-lg-4 col-sm-6 mb-4'>";
              echo "<div class='portfolio-item'>";

              echo "<a class='portfolio-link' data-toggle='modal' href='#id".$dt['SDT_GS']."'>";
              echo "<div class='portfolio-hover'>";
              echo "<div class='portfolio-hover-content'><i class='fas fa-plus fa-3x'></i></div>";
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
            }
          }
        //}
      ?>
    </div>
  </div>

  <div class="pagination" style="margin:0 auto">
    <?php
      if ($current_page1 > 1) {
        $pre_page1 = $current_page1 - 1;
    ?>
      <a class="current-page" href="?per_page1<?=$item_page1?>&page1=<?=$pre_page1?>&id=#portfolio">PRE</a>
    <?php } ?>
      <?php for ($num=1; $num <= $totalpage1; $num++) { ?>
      <?php if ($num != $current_page1) { ?>
      <?php if ($num > $current_page1 - 3 && $num < $current_page1 + 3) { ?>
      <a class="current-page" href="?per_page1=<?=$item_page1?>&page1=<?=$num?>&id=#portfolio"><?=$num?></a>
    <?php } ?>
    <?php } else { ?>
      <strong class="current-page"><?=$num?></strong>
    <?php } ?>
      <?php } ?>
    <?php
      if ($current_page1 < $totalpage1 - 1) {
    $next_page1 = $current_page1 + 1; ?>
      <a class="current-page" href="?per_page1<?=$item_page1?>&page1=<?=$next_page1?>&id=#portfolio">NEXT</a>
    <?php } ?>
</section>

<!-- MODAL LIST -->
<?php
if($result->num_rows > 0)
{
  foreach ($result as $dt){
    echo "<div class='portfolio-modal modal fade' id='id".$dt['SDT_GS']."'>";
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
                    $sdt = $dt['SDT_GS'];
                    $sql = "SELECT * FROM monday WHERE SDT_GS = '$sdt'";
                    $kq = $db->executeQuery($sql);

                    if($kq){
                      while ($r = $kq->fetch_array(MYSQLI_ASSOC)) {
                        echo '<ul class="list-group list-group-flush mb-5">';
                        echo '<li class="list-group-item"><strong>Môn học : </strong>'. $r['TenMonHoc'] .'</li>';
                        echo '<li class="list-group-item"><strong>Chi tiết môn học : </strong>'. $r['ChiTietMonHoc'] .'</li>';
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
                      $sql = "SELECT * FROM thoigianday WHERE SDT_GS = '$sdt'";
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
                  // echo "<a id='book' href='./controllers/update_confirm_post.php?id=".$dt['SDT_GS']."' class='btn btn-danger mt-5' data-dismiss='modal' type='button'>Đăng ký</a>";
                  echo "<a id='book' href='./controllers/update_confirm_bookgs.php?id=".$dt['SDT_GS']."' class='btn btn-danger mt-5'>Chọn gia sư</a>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";
  }
}
?>

            <script>
              $(document).ready(function(){
                $("#book").click(function(){
                    alert('Bạn đã chọn gia sư. Mời bạn xác nhận lần nữa');
                });
              });
            </script>

<?php $db->close(); ?>