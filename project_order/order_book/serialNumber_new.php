<?php
date_default_timezone_set('Asia/Taipei');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$db_host = "localhost";
$db_user = 'the_travel_project';
$db_pass =  '';
$db_name = 'the_travel_project';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

// 獲取當前日期和時間的格式（僅包含年月日）
$currentDate = date("Ymd");

// 檢查是否需要重置流水號
if (!isset($_SESSION['current_date']) || $_SESSION['current_date'] != $currentDate) {
    $_SESSION['current_date'] = $currentDate;
    $_SESSION['max_serial'] = 0;
}

// 生成交易ID
$transaction_id = '';
do {
    $_SESSION['max_serial']++;
    $max_serial_formatted = sprintf('%06d', $_SESSION['max_serial']);
    $transaction_id = $currentDate . $max_serial_formatted;

    // 檢查交易ID是否已存在
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM transactions WHERE transaction_id = :transaction_id");
    $stmt->bindParam(':transaction_id', $transaction_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $exists = $row['count'] > 0;
} while ($exists);

// 將交易ID寫入資料庫
$stmt = $pdo->prepare("INSERT INTO transactions (transaction_id) VALUES (:transaction_id)");
$stmt->bindParam(':transaction_id', $transaction_id);
$stmt->execute();

// 輸出結果
// echo  $transaction_id;
