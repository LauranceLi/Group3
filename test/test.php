<?php

  session_start();
  $title = "歡迎回來";
  $pageName = 'homepage';
  
?>
<?php include '../parts/html-head.php' ?>

<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>

<iframe src="../itinerary/itinerary.php" width="1400" height="2000" frameborder="0"></iframe>




<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<?php include '../parts/html-foot.php' ?>