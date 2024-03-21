<?php

require __DIR__ . '/interest_pdo-connect.php'; #附上資料庫連結

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;


//如果值不是零
if (!empty($sid)) {
    $sql = "DELETE FROM interest_list WHERE sid=$sid";
    $pdo->query($sql);
}


// 刪資料後會留在當前頁面
header("Location: interest_list.php");
