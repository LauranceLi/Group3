<?php
require __DIR__ . '/parts/pdo_connect.php';
session_start();
// print_r($_POST);

if (!empty($_POST)) {
  $the_employee = $_SESSION['admin']['employee_id'];
  $new_role_sql = "INSERT INTO `role_set`(`role_name`, `description`, `created_at`, `employee_id`) VALUES ('" . $_POST['new_role_name'] . "','" . $_POST['new_role_desc'] . "',NOW(),'$the_employee')";
  $new_role_result = $conn->query($new_role_sql);

  $new_role_row = $conn->query("SELECT role_id FROM role_set order by created_at desc limit 1")->fetch_assoc();

  $new_role_id = $new_role_row['role_id'];
  //新增逻辑

  $isAuthorized = isset($_POST['isAuthorized']) ? $_POST['isAuthorized'] : [];


  $roleSet = isset($_POST['roleSet']);
  $employee = isset($_POST['employee']);
  $member = isset($_POST['member']);
  $point = isset($_POST['point']);
  $itinerary = isset($_POST['itinerary']);
  $order = isset($_POST['order']);
  $product = isset($_POST['product']);
  $form = isset($_POST['form']);
  
  function authorized($sql) {
    if (empty($sql)){
      return 'noAuthority';
    } else if (in_array('edit', $sql)) {
      return 'edit';
    } else {
      return 'view';
    }
    }
  
    $roleSetAuthorized = authorized($_POST['roleSet']);
    $employeesAuthorized = authorized($_POST['employee']);
    $membersAuthorized = authorized($_POST['member']);
    $pointsAuthorized = authorized($_POST['point']);
    $itineraryAuthorized = authorized($_POST['itinerary']);
    $ordersAuthorized = authorized($_POST['order']);
    $productsAuthorized = authorized($_POST['product']);
    $formAuthorized = authorized($_POST['form']);



  $isAuthorized_sql =
    "INSERT INTO `permission`(`permission_role_id`, `role_set`, `employees`, `members`, `points`, `itinerary`, `orders`, `products`, `form`)VALUES ($new_role_id,'$roleSetAuthorized','$employeesAuthorized','$membersAuthorized','$pointsAuthorized','$itineraryAuthorized','$ordersAuthorized','$productsAuthorized','$formAuthorized')";

  $isAuthorized_sql_result = $conn->query($isAuthorized_sql);
  header("Location: roleList-success.php");
  exit; 
}
