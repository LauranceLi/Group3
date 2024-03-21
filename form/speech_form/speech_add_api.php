<?php
require __DIR__ . '/speech_pdo-connect.php'; #附上資料庫連結

header('Content-Type: application/json'); 

$output=[
    'success' => false,
    'postData' =>$_POST, #除錯用
    'error' =>'',
    'code' =>0, #除錯或追蹤程式碼
];

#如果這一欄位，不是空的才執行。如果空的就不處理。(就是只填name，可以新增了，放必填的欄位)
if (!empty($_POST['group_id'])) {

    $isPass = true;
// 在Network 回應的訊息
    if(mb_strlen($_POST['group_id']) > 100){
        $isPass=false;
        $output['error']='輸入的行程編號錯誤';
    }

    if($isPass){
        #避免 SQL injection(不會因SQL語法或是輸入一些符號造成問題) $stmt->execute;
        $sql="INSERT INTO `speech_list`(`group_id`, `speechtime`, `speechplace`, `speechtell`, `speechname`, `speechpeoplelimit`, `country`, `introduction`) VALUES (?,?,?,?,?,?,?,?)";

        $stmt=$pdo->prepare($sql);
        $stmt->execute([
            $_POST['group_id'],
            $_POST['speechtime'],
            $_POST['speechplace'],
            $_POST['speechtell'],
            $_POST['speechname'],
            $_POST['speechpeoplelimit'],
            $_POST['country'],
            $_POST['introduction'],
            ]);
            $output['success']=boolval($stmt->rowCount());
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

