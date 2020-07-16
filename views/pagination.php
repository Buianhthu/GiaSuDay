<div class="pagination">
  <?php
    if ($current_page > 1) {
      $pre_page = $current_page - 1;
    ?>
      <a class="current-page" href="?per_page<?=$item_page?>&page=<?=$pre_page?>&id=#services">PRE</a>
    <?php } ?>
      <?php for ($num=1; $num <= $totalpage; $num++) { ?>
      <?php if ($num != $current_page) { ?>
      <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
      <a href="?per_page=<?=$item_page?>&page=<?=$num?>&id=#services"><?=$num?></a>
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