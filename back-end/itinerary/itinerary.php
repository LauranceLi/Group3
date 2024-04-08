<?php

  session_start();
  $title = "套裝行程";
  $pageName = 'itinerary';
  
?>
<?php include '../parts/html-head.php' ?>

<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>

<div class="row">
  <div class="col">
  <iframe src="../itinerary_/itinerary.php"  height="1550" frameborder="0" class="border rounded w-100 p-4"></iframe>
  </div>
</div>




<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<?php include '../parts/html-foot.php' ?>