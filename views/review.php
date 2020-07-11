<?php
      require_once('./models/data_access_helper.php');
      $db = new DataAccessHelper();

      // Connect to database
      $db->connect();
      $qr = 'SELECT * FROM Review  
      INNER JOIN ThanhVien ON Review.SDT_TV = ThanhVien.SDT_TV
      INNER JOIN User ON Review.SDT_TV = User.SDT';
      $result = $conn->query($qr);
?>

<section class="page-section" id="about">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">ĐÁNH GIÁ GIA SƯ <i class="fas fa-search" style="margin-left:10px"></i></h2>
        <h3 class="section-subheading text-muted">Chất lượng, uy tín, thành công.</h3>
      </div>
            <ul class='timeline'>
              <li>
                <div class="timeline-image avatar_nen"><i class="fas fa-angle-double-up"></i></div>
              </li>
            <?php
              $i = 1;
              if($result->num_rows > 0)
              {
                foreach ($result as $dt){
                  if($i % 2 != 0)
                    {
                      echo "<li class='timeline-inverted'>";
                      
                      echo '<div class="timeline-image avt" style="background-image:url('."'".$dt["Avatar"]."'".')"></div>';
                      echo "<div class='timeline-panel'>";
                      echo "<div class='timeline-heading'>";
                      echo "<h4>March 2011</h4>";
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
                      echo "<h4>December 2012</h4>";
                      echo "<h4 class='subheading'>".$dt['HoTen']."</h4>";
                      echo "</div>";
                      echo "<div class='timeline-body'><p class='text-muted'>".$dt['NoiDung']."</p></div>";
                      echo "</div>";
                      echo "</li>";
                      $i++;
                    }

                  }
              }
              ?>
              <li>
                <div class="timeline-image avatar_nen"><i class="fas fa-angle-double-down"></i></div>
              </li>
            </ul>
            
  </div>
</section>