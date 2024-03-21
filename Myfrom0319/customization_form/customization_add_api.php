<?php
require __DIR__ . '/customization_pdo-connect.php'; #附上資料庫連結

header('Content-Type: application/json');

$output=[
    'success' => false,
    'postData' =>$_POST, #除錯用
    'error' =>'',
    'code' =>0, #除錯或追蹤程式碼
];

#如果這一欄位，不是空的才執行。如果空的就不處理。(就是只填name，可以新增了，放必填的欄位)
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
    if(mb_strlen($_POST['mobile']) != 10){
        $isPass=false;
        $output['error']='手機號碼請輸入10碼';
    }

    if($isPass){
        #避免 SQL injection(不會因SQL語法或是輸入一些符號造成問題) $stmt->execute;
        $sql = "INSERT INTO `customization_list`(`name`, `mobile`, `email`, `place`, `transportation`, `budget`, `calltime`) VALUES (?,?,?,?,?,?,?)";

        $stmt=$pdo->prepare($sql);
        $stmt->execute([
            $_POST['name'],
            $_POST['mobile'],
            $_POST['email'],
            $_POST['place'],
            $_POST['transportation'],
            $_POST['budget'],
            $_POST['calltime'],
        ]);
        $output['success']=boolval($stmt->rowCount());
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

