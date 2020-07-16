<?php
  // echo '<div class="cc" id="cc" data-toggle="modal" href="#uploadChungchi" style="background-image:url(';
  // echo "'";
  // require_once('controllers/get_chungchi_gs.php'); // Trả về link
  // echo "')" .'">';
  // echo '</div>';

  echo '<div class="cc" id="cc" data-toggle="modal" href="#uploadChungchi">';
  echo '<img class="img-fluid" src="';
  require_once('controllers/get_chungchi_gs.php'); // Trả về link
  echo '">';
  echo '</div>';
?>