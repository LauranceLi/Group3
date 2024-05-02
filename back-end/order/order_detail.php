<?php require __DIR__ . '/parts/pdo-connect.php';
require __DIR__ . '/parts/admin-required.php';
$title = '訂單明細';
$pageName = 'order_detail';

$transaction_id = isset($_GET['transaction_id']) ? intval($_GET['transaction_id']) : 0;

if (empty($transaction_id)) {
    header('Location: list.php');
    exit;
}

$rows = [];
$rows = $pdo->query("SELECT * FROM `order_detail` WHERE transaction_id=$transaction_id")->fetchAll();

$total_amount = 0;
$detail_amounts = [];
foreach ($rows as $row) {
    // 計算單項總額
    $detail_amount = $row['quantity'] * $row['unit_price'];
    $detail_amounts[] = $detail_amount;

    // 計算總額
    $total_amount += $detail_amount - $row['points'];
}

$detail_amounts_str = implode(' ', $detail_amounts);
$sql = "UPDATE  `order` SET `total_amount`=?  WHERE `transaction_id`=?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $total_amount,
    $transaction_id
]);

?>



<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<div class="container">
    <table class="table table-bordered table-striped mt-5">
        <thead>
            <tr>
                <th>交易編號</th>
                <th>商品id</th>
                <th>商品單價</th>
                <th>數量</th>
                <th>折扣</th>
                <th>商品明細</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $key => $row) : ?>
                <tr>
                    <td><?= $row['transaction_id'] ?></td>
                    <td><?= $row['product_id'] ?></td>
                    <td><?= $row['unit_price'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['points'] ?></td>
                    <td><?= $detail_amounts[$key] ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="6">總金額：<?= $total_amount ?></td>
            </tr>
        </tbody>
    </table>
    <div class="mt-3">
        <a class="btn btn-primary" href="javascript:location.href=document.referrer">返回列表</a>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php' ?>
<?php include __DIR__ . '/parts/html-foot.php' ?>