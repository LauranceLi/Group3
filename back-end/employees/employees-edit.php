<?php
  require '../parts/pdo_connect.php';
session_start();
// print_r($_POST);
$role_id = $_GET['employees_id'];
if (!empty($_POST)){
$edit_sql = "SELECT *
FROM permission
INNER JOIN employees
ON employees.role_id = permission.permission_role_id
WHERE role_id = $role_id ";
$edit_sql_result = $conn->query($edit_sql)->fetch_assoc();

$edit_role_desc = $_POST[$role_id.'edit_role_desc'];


function editAuthorized($sql) {
  if (empty($sql)){
    return 'noAuthority';
  } else if (in_array('edit', $sql)) {
    return 'edit';
  } else {
    return 'view';
  }
  }


  $roleSetAuthorized = editAuthorized($_POST[$role_id.'roleSet']?? null);
  $employeesAuthorized = editAuthorized($_POST[$role_id.'employee']?? null);
  $membersAuthorized = editAuthorized($_POST[$role_id.'member']?? null);
  $pointsAuthorized = editAuthorized($_POST[$role_id.'point']?? null);
  $itineraryAuthorized = editAuthorized($_POST[$role_id.'itinerary'] ?? null);
  $ordersAuthorized = editAuthorized($_POST[$role_id.'order']?? null);
  $productsAuthorized = editAuthorized($_POST[$role_id.'product']?? null);
  $formAuthorized = editAuthorized($_POST[$role_id.'form']?? null);





$editAuthority_sql = 
"UPDATE `permission` 
SET 
`employees`='$roleSetAuthorized',
`employees`='$employeesAuthorized', 
`members`='$membersAuthorized',
`points`='$pointsAuthorized',
`itinerary`='$itineraryAuthorize',
`orders`='$ordersAuthorized',
`products`='$productsAuthorized',
`form`='$formAuthorized'
WHERE permission_role_id = $role_id";

$update_role_desc_sql = "UPDATE `employees` SET `description`='$edit_role_desc' WHERE role_id = $role_id"; 

$editAuthority_sql_result = $conn->query($editAuthority_sql);
$update_role_desc_result = $conn->query($update_role_desc_sql);
$backTo = 'roleList-success.php';
header("Location:$backTo");
exit; 
}

