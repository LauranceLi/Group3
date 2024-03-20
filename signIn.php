<?php
header('Content-type:text/html; charset=utf-8');
session_start();
include './parts/pdo_connect.php';

$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);


$employee_sql = "SELECT * FROM employees INNER JOIN role_set ON role_set.role_id = employees.employee_role_id WHERE email='$email'";
$employee_result = $conn->query($employee_sql);

if ($employee_result->num_rows == 1) {
  $employee_row = $employee_result->fetch_assoc();
  // 获取基本资料
  if ($password === $employee_row['password']) {
    $_SESSION['admin'] = [
      'employee_id' => $employee_row['employee_id'],
      'employee_role_id' => $employee_row['employee_role_id'],
      'email' => $employee_row['email'],
      'employee_nickname' => $employee_row['employee_nickname'],
      'role_name' => $employee_row['role_name'],
    ];
    $role_id = $_SESSION['admin']['employee_role_id'];


  //获取权限
  $permission_sql =
  "SELECT *
  FROM permission
  INNER JOIN role_set
  ON role_set.role_id = permission.permission_role_id
  WHERE role_id = $role_id";

  $permission_result = $conn->query($permission_sql);
  $permission_row = $permission_result->fetch_assoc();
  $_SESSION['permission'] = [
    'role_set' => $permission_row['role_set'],
    'role_name' => $permission_row['role_name'],
    'employees' => $permission_row['employees'],
    'members' => $permission_row['members'],
    'points' => $permission_row['points'],
    'itinerary' => $permission_row['itinerary'],
    'orders' => $permission_row['orders'],
    'products' => $permission_row['products'],
    'form' => $permission_row['form']
  ];



    header("Location: index_.php");
    exit();
  } else {
    $signinResultText = "密碼錯誤，請重新嘗試。";
  }
} else {
  $signinResultText = "帳號不存在，請聯繫管理員。";
}

$conn->close();
?>
<!-- error Start -->
<div class="container-fluid ">
  <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
    <div class="col-md-6 text-center p-4">
      <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
      <h1 class="mb-4 mt-4"><?php echo $signinResultText ?></h1>
      <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">重新登入</a>
    </div>
  </div>
</div>
<!-- error End -->


<?php include __DIR__ . '/parts/html-head.php' ?>