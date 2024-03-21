<?php

require __DIR__ . '/customization_pdo-connect.php'; #附上資料庫連結

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;


//如果值不是零
if (!empty($sid)) {
    $sql = "DELETE FROM customization_list WHERE sid=$sid";
    $pdo->query($sql);
}


// 刪資料後會留在當前頁面
header("Location: customization_list.php");