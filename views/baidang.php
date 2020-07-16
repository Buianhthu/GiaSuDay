<?php
  require_once('./models/data_access_helper.php');
  // Create an instance of data access helper
  $db = new DataAccessHelper();

  // Connect to database
  $db->connect();

  $item_page2 = !empty($_GET['per_page2'])?$_GET['per_page2']:3;
  $current_page2 = !empty($_GET['page2'])?$_GET['page2']:1;
  $offset2 = ($current_page2 - 1) * $item_page2;
  $result = mysqli_query($conn, "SELECT * FROM TimGiaSu INNER JOIN ThanhVien WHERE TimGiaSu.SDT_TV = ThanhVien.SDT_TV LIMIT ".$item_page2." OFFSET ".$offset2."");
  $sum_item2 = mysqli_query($conn, "SELECT * FROM TimGiaSu INNER JOIN ThanhVien WHERE TimGiaSu.SDT_TV = ThanhVien.SDT_TV");
  $sum_item2 = $sum_item2 -> num_rows;
  $totalpage2 = ceil ($sum_item2/$item_page2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Gia Sư Đây</title>
  <!-- Icon trang web -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/override.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
</head>
<body>

 <section class="page-section" id="baidang">
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
                        echo "<li>";
                        echo "<h4 class='my-3' name='hoten'>".$dt['HoTen']."</h4>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Số Điện Thoại: ".$dt['SDT_TV']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Tên Môn Học: </br>".$dt['TenMonHoc']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Thời Gian Học: </br>".$dt['ThoiGianHoc']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Học Phí: ".$dt['HocPhi']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<a href='views/info_course_gs.php?id=".$dt['Id']."' class='btn btn-danger mt-5'>Xem chi tiết</a>";
                        echo "</li>";
                        echo "<li><a id='confirm' href='./controllers/update_confirm_post.php?id=".$dt['Id']."'>Nhận lớp ngay</a></li>";
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
                        echo "<p class='text-muted'>"."Số Điện Thoại: ".$dt['SDT_TV']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Tên Môn Học: </br>".$dt['TenMonHoc']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Thời Gian Học: </br>".$dt['ThoiGianHoc']."</p>";
                        echo "</li>";
                        echo "<li>";
                        echo "<p class='text-muted'>"."Học Phí: ".$dt['HocPhi']."</p>";
                        echo "</li>";
                        echo "<li><a id='myBtn' href='./controllers/update_confirm_post.php?id=".$dt['Id']."'style='pointer-events: none'>Chờ xác nhận</a></li>";
                        echo "</ul>";
                        echo "</div>";
                    }     
             }
          }    
        ?>

          <script>
            $(document).ready(function(){
              $("#confirm").click(function(){
                alert("Cảm ơn bạn đã nhận lớp. Mời bạn xác nhận lại lần nữa");
              });
            });
          </script>
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


      </div>
    </div> 
  </br>
      


  </section>
</body>
</html>

