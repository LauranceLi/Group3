<?php
  require __DIR__ . '/parts/pdo_connect.php';
  session_start();
  $title = "會員管理";
  $pageName = 'members';
  
?>

<?php include __DIR__. '/parts/html-head.php' ?>
<?php include __DIR__. '/parts/spinner.php' ?>
<?php include __DIR__. '/parts/slidebar.php' ?>
<?php include __DIR__. '/parts/navbar.php' ?>



<?php include __DIR__. '/parts/footer.php' ?>
<?php include __DIR__ . '/parts/scripts.php' ?>
<?php include __DIR__ . '/parts/html-foot.php' ?>