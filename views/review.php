<?php
      require_once('models/data_access_helper.php');
      $db = new DataAccessHelper();

      // Connect to database
      $db->connect();

      $item_page3 = !empty($_GET['per_page3'])?$_GET['per_page3']:3;
      $current_page3 = !empty($_GET['page3'])?$_GET['page3']:1;
      $offset3 = ($current_page3 - 1) * $item_page3;
      $result = mysqli_query($conn, "SELECT * FROM Review, HocVien,User WHERE Review.Username = HocVien.Username AND HocVien.username = User.Username LIMIT ".$item_page3." OFFSET ".$offset3."");
      $sum_item3 = mysqli_query($conn, "SELECT * FROM Review, HocVien, User WHERE Review.Username = HocVien.Username AND HocVien.username = User.Username ");
      $sum_item3 = $sum_item3 -> num_rows;
      $totalpage3 = ceil ($sum_item3/$item_page3);
?>

<section class="page-section" id="review">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">ĐÁNH GIÁ GIA SƯ <i class="fas fa-search" style="margin-left:10px"></i></h2>
        <h3 class="section-subheading text-muted">Chất lượng, uy tín, thành công.</h3>
      </div>
            <ul class='timeline'>
             <!--  <li>
                
                <div class="timeline-image avatar_nen">
                 <i class="fas fa-angle-double-up"></i>
                </div>
              </li> -->
            <?php
              $i = 1;
              if($result->num_rows > 0)
              {
                foreach ($result as $dt){
                  if ($dt['KiemDuyet'] == 1)
                  {
                      if($i % 2 != 0)
                        {
                          echo "<li class='timeline-inverted'>";
                          
                          echo '<div class="timeline-image avt" style="background-image:url('."'".$dt["Avatar"]."'".')"></div>';
                          echo "<div class='timeline-panel'>";
                          echo "<div class='timeline-heading'>";
                          echo "<h4>".$dt['NgayDang']."</h4>";
                          echo "<h4 class='subheading'>".$dt['HoTen']."</h4>";
                          echo "</div>";
                          echo "<div class='timeline-body'><p class='text-muted'>".$dt['NoiDung']."</p></div>";
                          echo "</div>";
                          echo "</li>";
                          $i++;
                        } else {
                          echo "<li>";
                          
                          echo '<div class="timeline-image avt" style="background-image:url('."'".$dt["Avatar"]."'".')"></div>';
                          echo "<div class='timeline-panel'>";
                          echo "<div class='timeline-heading'>";
                          echo "<h4>".$dt['NgayDang']."</h4>";
                          echo "<h4 class='subheading'>".$dt['HoTen']."</h4>";
                          echo "</div>";
                          echo "<div class='timeline-body'><p class='text-muted'>".$dt['NoiDung']."</p></div>";
                          echo "</div>";
                          echo "</li>";
                          $i++;
                        }

                      }
                  }
                }
              ?>
              </ul>

              <div class="pagination" style="margin:0 auto">
                <?php
                  if ($current_page3 > 1) {
                    $pre_page3 = $current_page3 - 1;
                  ?>
                    <a class="current-page" href="?per_page3<?=$item_page3?>&page3=<?=$pre_page3?>&id=#review">PRE</a>
                  <?php } ?>
                    <?php for ($num=1; $num <= $totalpage3; $num++) { ?>
                    <?php if ($num != $current_page3) { ?>
                    <?php if ($num > $current_page3 - 3 && $num < $current_page3 + 3) { ?>
                    <a class="current-page" href="?per_page3=<?=$item_page3?>&page3=<?=$num?>&id=#review"><?=$num?></a>
                  <?php } ?>
                  <?php } else { ?>
                    <strong class="current-page"><?=$num?></strong>
                  <?php } ?>
                    <?php } ?>
                  <?php
                    if ($current_page3 < $totalpage3 - 1) {
                  $next_page3 = $current_page3 + 1; ?>
                    <a class="current-page" href="?per_page3<?=$item_page3?>&page3=<?=$next_page3?>&id=#review">NEXT</a>
                  <?php } ?>
              </div> 
            
            
  </div>
</section>