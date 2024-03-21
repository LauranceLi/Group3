<?php
require __DIR__ . '/speech_pdo-connect.php'; #附上資料庫連結
header('Content-Type: application/json');

# 回應給用戶端的欄位 (格式 JSON)
$output = [
  'success' => false,
  'postData' => $_POST, # 除錯用
  'error' => '',
  'code' => 0, # 除錯或追踪程式碼
];


// 判斷表單有無送過來
// 如過這欄是空的
if (!empty($_POST['sid']) and !empty($_POST['group_id'])) {

$isPass = true;

// 在Network 回應的訊息
    if(mb_strlen($_POST['group_id']) > 100){
        $isPass=false;
        $output['error']='輸入的行程編號錯誤';
    }

if ($isPass) {
  # 避免 SQL injection
  $sql = "UPDATE `speech_list` SET 
  `group_id`=?,
  `speechtime`=?,
  `speechplace`=?,
  `speechtell`=?,
  `speechname`=?,
  `speechpeoplelimit`=?,
  `country`=?,
  `introduction`=?
  WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['group_id'],
  $_POST['speechtime'],
  $_POST['speechplace'],
  $_POST['speechtell'],
  $_POST['speechname'],
  $_POST['speechpeoplelimit'],
  $_POST['country'],
  $_POST['introduction'],
  $_POST['sid'],
  ]);
    $output['success'] = boolval($stmt->rowCount());
  }
echo json_encode($output, JSON_UNESCAPED_UNICODE);
}