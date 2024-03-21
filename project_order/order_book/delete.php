<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if (!empty($order_id)) {
    $sql =  "DELETE FROM `order` WHERE order_id=$order_id ";
    $pdo->query($sql);
}

//刪除時頁面跳轉到當下的頁面(不再跳轉到第一頁)  HTTP_REFERER上一個網頁的URL
$backTo = 'orderList.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $backTo = $_SERVER['HTTP_REFERER'];
}

header("Location:$backTo");

