<?php
require '../parts/pdo_connect.php';
session_start();
$title = "歡迎回來";
$pageName = 'homepage';

?>
<?php include '../parts/html-head.php' ?>
<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>

<?php
date_default_timezone_set('Asia/Shanghai');
$current_time = date("Y-m-d H:i:s");
$current_hour = date('H:i');

$another_hour = date('H:i', strtotime('12:00'));

if ($current_hour > $another_hour) {
  $greeting = '下午好';
} else {
  $greeting = '上午好';
}
?>
<!-- Widget Start -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-12 col-md-6 col-xl-8">
      <div class="h-100 bg-secondary rounded p-4 d-flex flex-column align-items-center justify-content-center">

          <h1 class="mb-3"><i class="fa-regular fa-thumbs-up fa-2xl text-primary"></i></h1>
          <h3 class="mt-2 mb-2">歡迎回來</h3>
          <h5><?= $_SESSION['admin']['employee_nickname'] . '，' . $greeting . '。' ?></h5>
          <p>現在時間是 <?= $current_time ?>。</p>

      </div>
    </div>
    <div class="col-sm-12 col-md-6 col-xl-4">
      <div class="h-100 bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h6 class="mb-0">日曆</h6>
        </div>
        <div id="calender"></div>
      </div>
    </div>

  </div>
</div>
<!-- Widget End -->

<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<?php include '../parts/html-foot.php' ?>