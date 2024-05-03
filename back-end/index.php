<?php
require __DIR__ . '/parts/pdo_connect.php';
session_start();
$title = "登入";
$pageName = 'index';

?>

<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
  <meta charset="utf-8">
  <title><?= empty($title) ? '第三小组專题' : "$title - 第三小组專题" ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <?php include __DIR__ . '/parts/spinner.php' ?>

  <!-- Sign In Start -->
  <div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
      <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <a href="#" class="">
              <h3 class="text-primary"><i class="fa-solid fa-tree me-2"></i>締杉旅遊</h3>
            </a>
            <h3>員工後臺系統</h3>
          </div>
          <form name="signInForm" method="POST" action="signIn.php">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="DEP-TI-001">
              <label for="employee_id">帳號</label>
            </div>
            <div class="form-floating mb-4">
              <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
              <label for="floatingPassword">密碼</label>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-4">
              <a href="">忘記密碼</a>
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">登入</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Sign In End -->


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="lib/chart/chart.min.js"></script>

  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="https://kit.fontawesome.com/f3c3056260.js" crossorigin="anonymous"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
  </body>

</html>