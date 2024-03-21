<?php
require __DIR__ . '/customization_pdo-connect.php'; #附上資料庫連結
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
if (!empty($_POST['name'])) {

$isPass = true;

// 在Network 回應的訊息
    if(mb_strlen($_POST['name']) < 2){
        $isPass=false;
        $output['error']='姓名請填兩個字以上';
    }
    if(mb_strlen($_POST['email']) and ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $isPass=false;
        $output['error']='Email 請符合格式';
    }
    if(mb_strlen($_POST['mobile']) < 9){
        $isPass=false;
        $output['error']='手機號碼請輸入10碼';
    }

if ($isPass) {
  # 避免 SQL injection
  $sql = "UPDATE `customization_list` SET 
  `name`=?,
  `mobile`=?,
  `email`=?,
  `place`=?,
  `transportation`=?,
  `budget`=?,
  `calltime`=?
  WHERE `sid`=?";


$stmt = $pdo->prepare($sql);
    $stmt->execute([
      $_POST['name'],
      $_POST['mobile'],
      $_POST['email'],
      $_POST['place'],
      $_POST['transportation'],
      $_POST['budget'],
      $_POST['calltime'],
      $_POST['sid'],
    ]);
    $output['success'] = boolval($stmt->rowCount());
  }
echo json_encode($output, JSON_UNESCAPED_UNICODE);
}