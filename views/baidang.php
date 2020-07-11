<?php
  require_once('./models/data_access_helper.php');
  // Create an instance of data access helper
  $db = new DataAccessHelper();

  // Connect to database
  $db->connect();

  $item_page = !empty($_GET['per_page'])?$_GET['per_page']:3;
  $current_page = !empty($_GET['page'])?$_GET['page']:1;
  $offset = ($current_page - 1) * $item_page;
  $result = mysqli_query($conn, "SELECT * FROM TimGiaSu INNER JOIN ThanhVien WHERE TimGiaSu.SDT_TV = ThanhVien.SDT_TV LIMIT ".$item_page." OFFSET ".$offset."");
  $sum_item = mysqli_query($conn, "SELECT * FROM TimGiaSu INNER JOIN ThanhVien WHERE TimGiaSu.SDT_TV = ThanhVien.SDT_TV");
  $sum_item = $sum_item -> num_rows;
  $totalpage = ceil ($sum_item/$item_page);

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

 <section class="page-section" id="services">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Tìm Gia Sư<i class="fas fa-user-graduate" style="margin-left:10px"></i></h2>
        <h3 class="section-subheading text-muted"><i class="fas fa-hands-helping" style="margin-right:10px; font-weight: 30px"></i>Chúng tôi cần bạn<i class="fas fa-hands-helping" style="margin-left:10px"></i></h3>
      </div>

      <div class="row text-center">
            <?php
              if($result->num_rows > 0 || $result2->num_rows > 0)
              {
                foreach ($result as $dt){
                  if ($dt['TinhTrang'] == -1)
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
                        echo "<li><a href='./controllers/update_confirm_post.php?id=".$dt['Id']."'style='padding:.2rem;background:#fed136;text-decoration:none;color:white'>Nhận lớp ngay</a></li>";
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
                        echo "<li><a id='myBtn' href='./controllers/update_confirm_post.php?id=".$dt['Id']."'style='padding:.2rem;background:#fed136;text-decoration:none;color:white'>Chờ xác nhận</a></li>";
                        echo "</ul>";
                        echo "</div>";
                    }
                        
             }
          }    
        ?>
          <!-- <script>
            $(document).ready(function(){
              $("a").click(function(){
                alert("Cảm ơn bạn đã nhận lớp. Mời bạn xác nhận lại lần nữa");
                $(this).css('background-color', 'red');
                $(this).prop('disabled', true);
              });
            });
          </script> -->
    </div>
              <div class="pagination" style="margin:0 auto">
                <?php
                  if ($current_page > 1) {
                    $pre_page = $current_page - 1;
                  ?>
                    <a class="current-page" href="?per_page<?=$item_page?>&page=<?=$pre_page?>&id=#services">PRE</a>
                  <?php } ?>
                    <?php for ($num=1; $num <= $totalpage; $num++) { ?>
                    <?php if ($num != $current_page) { ?>
                    <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                    <a class="current-page" href="?per_page=<?=$item_page?>&page=<?=$num?>&id=#services"><?=$num?></a>
                  <?php } ?>
                  <?php } else { ?>
                    <strong class="current-page"><?=$num?></strong>
                  <?php } ?>
                    <?php } ?>
                  <?php
                    if ($current_page < $totalpage - 1) {
                  $next_page = $current_page + 1; ?>
                    <a class="current-page" href="?per_page<?=$item_page?>&page=<?=$next_page?>&id=#services">NEXT</a>
                  <?php } ?>
              </div> 
      </div>
    </div> 
  </br>
   <div id="link">
      <a id='ds' href='./danhsachbaidang.php'>Xem danh sách<i class="fas fa-list-alt" style="margin-left:10px"></i></a>
    </div>


  </section>
</body>
</html>

