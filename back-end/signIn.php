<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-type:text/html; charset=utf-8');
session_start();
include './parts/pdo_connect.php';
if (isset($_SESSION['admin'])) {
  header('Location: homepage/homepage.php');
}

$employee_id = $conn->real_escape_string($_POST['employee_id']);
$password = $conn->real_escape_string($_POST['password']);


$employee_sql =
  "SELECT * FROM employees 
INNER JOIN role_set ON role_set.role_id = employees.role_id 
INNER JOIN department ON department.department_id = employees.department_id
INNER JOIN title ON title.title_id = employees.title_id
WHERE employee_id='$employee_id'";
$employee_result = $conn->query($employee_sql);

if ($employee_result->num_rows == 1) {
  $employee_row = $employee_result->fetch_assoc();
  // 获取基本资料
  if ($password === $employee_row['password']) {
    $_SESSION['admin'] = [
      'employee_id' => $employee_row['employee_id'],
      'role_id' => $employee_row['role_id'],
      'employee_nickname' => $employee_row['employee_nickname'],
      'department_ch' => $employee_row['department_ch'],
      'title_ch' => $employee_row['title_ch'],
      'role_ch' => $employee_row['role_ch'],
    ];
    $role_id = $_SESSION['admin']['role_id'];


    //获取权限
    $permission_sql =
    "SELECT *
    FROM permission
    INNER JOIN role_set
    ON role_set.role_id = permission.role_id
    WHERE permission.role_id = '$role_id'";
  
  $permission_result = $conn->query($permission_sql)->fetch_assoc();
  
  $_SESSION['permission'] = [
    'role_set' => $permission_result['role_set'],
    'role_name' => $permission_result['role_name'],
    'employees' => $permission_result['employees'],
   'members' => $permission_result['members'],
    'points' => $permission_result['points'],
    'itinerary' => $permission_result['itinerary'],
    'orders' => $permission_result['orders'],
    'products' => $permission_result['products'],
    'form' => $permission_result['form']
  ];



    function isPermitted($func, $str)
    {
      $strArr = explode(',', $str);
      $_SESSION[$func]['create'] = in_array('C', $strArr) ? 'createPermitted' : '';
      $_SESSION[$func]['read'] = in_array('R', $strArr) ? 'readPermitted' : '';
      $_SESSION[$func]['upload'] = in_array('U', $strArr) ? 'updatePermitted' : '';
      $_SESSION[$func]['delete'] = in_array('D', $strArr) ? 'deletePermitted' : '';
      
    }

    isPermitted("role_set", $_SESSION['permission']['role_set']);
    isPermitted("employees", $_SESSION['permission']['employees']);
    isPermitted("members", $_SESSION['permission']['members']);
    isPermitted("points", $_SESSION['permission']['points']);
    isPermitted("itinerary", $_SESSION['permission']['itinerary']);
    isPermitted("orders", $_SESSION['permission']['orders']);
    isPermitted("products", $_SESSION['permission']['products']);
    isPermitted("form", $_SESSION['permission']['form']);







    header("Location: homepage/homepage.php");
    exit();
  } else {
    $signInResultText = "密碼錯誤，請重新嘗試。";
  }
} else {
  $signInResultText = "帳號不存在，請聯繫管理員。";
}

$conn->close();
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

  <!-- error Start -->

  <div class="container-fluid ">
    <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
      <div class="col-md-6 text-center p-4">
        <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
        <h1 class="mb-4 mt-4"><?php echo $signInResultText ?></h1>
        <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">重新登入</a>
      </div>
    </div>
  </div>
  </div>
  <!-- error End -->


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