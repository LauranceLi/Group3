<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'postData' => $_POST,  
    'error' => '',
    'code' => 0,     
];


if (!empty($_POST['purchaser_name']) && !empty($_POST['purchaser_email'])) {
    $isPass = true;
    if (mb_strlen($_POST['purchaser_name']) < 2) {
        $isPass = false;
        $output['error'] = ' 姓名總數2個字以上';
    }
    if (!empty($_POST['purchaser_email']) && !filter_var($_POST['purchaser_email'], FILTER_VALIDATE_EMAIL)) {
        $isPass = false;
        $output['error'] = ' Email需符合格式';
    }

try {
    if ($isPass) {
        $sql = "UPDATE `order` SET purchaser_name=?,purchaser_mobile=?,purchaser_email=?,recipient_name=?,recipient_mobile=?,payment_method=?,shipping_method=?,shipping_address=?,invoice_type=?,invoice_code=?,company_title=?,payment_status=?,shipping_status=?,shipping_date=?,order_status=? WHERE order_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['purchaser_name'],
            $_POST['purchaser_mobile'],
            $_POST['purchaser_email'],
            $_POST['recipient_name'],
            $_POST['recipient_mobile'],
            $_POST['payment_method'],
            $_POST['shipping_method'],
            $_POST['shipping_address'],
            $_POST['invoice_type'],
            $_POST['invoice_code'],
            $_POST['company_title'],
            $_POST['payment_status'],
            $_POST['shipping_status'],
            $_POST['shipping_date'],
            $_POST['order_status'],
            $_POST['order_id']
        ]);
        $output['success'] = boolval($stmt->rowCount());
    }

    } catch (PDOException $e) {
        $output['error'] = 'Database Error: ' . $e->getMessage();
    }
};

echo json_encode($output, JSON_UNESCAPED_UNICODE);


// <!-- 除錯(後端(伺服器)收到的資料傳送給用戶端(F12 RESPONSE)資料要一致) -->

