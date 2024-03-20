<?php
// require __DIR__ . '/parts/admin-require.php';
require __DIR__ . "/parts/pdo_connect.php";

$role_id = isset($_GET['role_id']) ? intval($_GET['role_id']) : 0;

if (! empty($role_id)) { 
  $role_set_sql = "DELETE FROM role_set WHERE role_id=$role_id";
  $conn->query($role_set_sql);
  $permission_sql = "DELETE FROM permission WHERE permission_role_id=$role_id";
  $conn->query($permission_sql);
  $backTo = 'roleList-success.php';
  header("Location:$backTo");
}

if (! empty($_SERVER['HTTP_REFERER'])){
  $backTo = $_SERVER['HTTP_REFERER'];

}

