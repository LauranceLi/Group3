<?php
$servername = "localhost"; // 資料庫伺服器名稱
$username = "the_travel_project"; // 資料庫使用者名稱
$password = ""; // 資料庫使用者密碼
$dbname = "the_travel_project"; // 資料庫名稱

// 建立資料庫連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
}
?>

<!-- $db_host = "127.0.0.1";
$db_user = 'the_travel_project';
$db_pass = ''; # 沒有密碼就留空字串
$db_name = 'the_travel_project'; # 資料庫名稱未定

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]; # 可視性佳

$pdo = new PDO($dsn, $db_user, $db_pass);  -->





