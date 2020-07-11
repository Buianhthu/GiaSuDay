<?php
      require_once('./models/data_access_helper.php');
      $db = new DataAccessHelper();

      // Connect to database
      $db->connect();
      // $qr = 'SELECT * FROM GiaSu INNER JOIN User WHERE GiaSu.SDT_GS = User.SDT';
      // $result = $conn->query($qr);

      $item_page = !empty($_GET['per_page'])?$_GET['per_page']:6;
      $current_page = !empty($_GET['page'])?$_GET['page']:1;
      $offset = ($current_page - 1) * $item_page;
      $result = mysqli_query($conn, "SELECT * FROM GiaSu INNER JOIN User WHERE GiaSu.SDT_GS = User.SDT LIMIT ".$item_page." OFFSET ".$offset."");
      $sum_item = mysqli_query($conn, "SELECT * FROM GiaSu INNER JOIN User WHERE GiaSu.SDT_GS = User.SDT");
      $sum_item = $sum_item -> num_rows;
      $totalpage = ceil ($sum_item/$item_page);
  ?>


<section class="page-section bg-light" id="portfolio">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">ĐỘI NGŨ GIA SƯ<i class="fas fa-users" style="margin-left:10px"></i></h2>
        <h3 class="section-subheading text-muted">Kiến thức vững vàng - Tương lai tươi sáng</h3>
      </div>
      <div class="row">
        <?php
              
                  if($result->num_rows > 0)
                  {
                    foreach ($result as $dt){
                          echo "<div class='col-lg-4 col-sm-6 mb-4'>";
                          echo "<div class='portfolio-item'>";
                          echo "<a class='portfolio-link' data-toggle='modal' href="."'#".$dt['SDT_GS']."'>";
                          echo "<div class='portfolio-hover'>";
                          echo "<div class='portfolio-hover-content'><i class='fas fa-plus fa-3x'></i></div>";
                          echo "</div>";
                          echo '<div class="avatar_gs" style="background-image:url('."'".$dt["Avatar"]."'".')"></div>';
                          echo "</a>";
                          echo "<div class='portfolio-caption'>";
                          echo "<div class='portfolio-caption-heading'>".$dt['HoTen']."</div>";
                          echo "<div class='portfolio-caption-subheading text-muted'>Lĩnh Vực: ".$dt['LinhVuc']."</div>";
                          echo "<div class='portfolio-caption-subheading text-muted'>Học Vị: ".$dt['HocVi']."</div>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                      }
                }
      ?>
    </div>
  </div>

  <div class="pagination" style="margin:0 auto">
  <?php
    if ($current_page > 1) {
      $pre_page = $current_page - 1;
    ?>
      <a class="current-page" href="?per_page<?=$item_page?>&page=<?=$pre_page?>&id=#portfolio">PRE</a>
    <?php } ?>
      <?php for ($num=1; $num <= $totalpage; $num++) { ?>
      <?php if ($num != $current_page) { ?>
      <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
      <a class="current-page" href="?per_page=<?=$item_page?>&page=<?=$num?>&id=#portfolio"><?=$num?></a>
    <?php } ?>
    <?php } else { ?>
      <strong class="current-page"><?=$num?></strong>
    <?php } ?>
      <?php } ?>
    <?php
      if ($current_page < $totalpage - 1) {
    $next_page = $current_page + 1; ?>
      <a class="current-page" href="?per_page<?=$item_page?>&page=<?=$next_page?>&id=#portfolio">NEXT</a>
    <?php } ?>
</section>
  <?php
   if($result->num_rows > 0)
    {
      foreach ($result as $dt){
        echo "<div class='portfolio-modal modal fade' id='#".$dt['SDT_GS']."'tabindex='-1' role='dialog' aria-hidden='true'>";
          echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
              echo "<div class='close-modal' data-dismiss='modal'><img src='assets/img/close-icon.svg' alt='Close modal' /></div>";
              echo "<div class='container'>";
                echo "<div class='row justify-content-center'>";
                    echo "<div class='col-lg-8'>";
                      echo "<div class='modal-body'>";
                        echo "<h2 class='text-uppercase'>".$dt['HoTen']."</h2>";
                        echo "<p class='item-intro text-muted'>".$dt['SDT_GS']."</p>";
                        echo "<img class='img-fluid d-block mx-auto' src='".$dt['Avatar']."'/>";
                        echo "<p>".$dt['MoTa']."</p>";
                        echo "<ul class='list-inline'>";
                          echo "<li>".$dt['Email']."</li>";
                          echo "<li>".$dt['LinhVuc']."</li>";
                          echo "<li>".$dt['ChuyenNganh']."</li>";
                          echo "<li>".$dt['HocVi']."</li>";
                          echo "<li>".$dt['NoiLamViec']."</li>";
                          echo "<li>".$dt['ChuyenNganh']."</li>";
                        echo "</ul>";
                        echo "<button class='btn btn-primary' data-dismiss='modal' type='button'><i class='fas fa-times mr-1'></i>Chọn Gia</button>";
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
                
  <!-- Portfolio Modals-->
  <!-- Modal 1-->
  <!--
  <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="modal-body">
              -->
                <!-- Project Details Go Here-->
                <!--
                <h2 class="text-uppercase">Project Name</h2>
                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/01-full.jpg" alt="" />
                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                <ul class="list-inline">
                  <li>Date: January 2020</li>
                  <li>Client: Threads</li>
                  <li>Category: Illustration</li>
                </ul>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times mr-1"></i>
                  Close Project
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
-->
  
</div> 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
   <!-- Third party plugin JS--> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <!-- Contact form JS-->
  <script src="assets/mail/jqBootstrapValidation.js"></script>
  <script src="assets/mail/contact_me.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script> 