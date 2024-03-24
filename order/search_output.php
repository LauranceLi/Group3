<?php require __DIR__ . '/parts/pdo-connect.php';
$title = '搜尋結果';
$pageName = 'orderList';
$isAbled = $_SESSION['permission']['orders'] == 'view' ? 'disabled' : '';
if ($_SESSION['permission']['orders']=='noAuthority'){
    header('Location: ../index.php');
    exit;
}
?>
<?php include '../parts/html-head.php' ?>
<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>
<?php

$keyword = isset($_REQUEST['keyword']) ? '%' . $_REQUEST['keyword'] . '%' : '%';
$sql = $pdo->prepare('SELECT * FROM `order` WHERE 
	order_status LIKE ? OR 
	transaction_id LIKE ? OR 
	purchaser_name LIKE ? OR 
	total_amount LIKE ? OR 
	payment_method LIKE ? OR 
	payment_status LIKE ? OR 
	shipping_method LIKE ? OR 
	shipping_status LIKE ? OR 
	shipping_address LIKE ? OR 
	shipping_date LIKE ? OR 
	order_date LIKE ?');
$sql->execute([$keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword]);
$rows = $sql->fetchAll();
$rowCount = count($rows);
?>

<div class="m-4">
	<div class="bg-secondary rounded h-100 p-4 w-100">
		<div class="row">
			<div class="col mt-3">
				<div class="searchbar d-flex justify-content-between">
					<?php include __DIR__ . '/filter.php'; ?>
					<?php include __DIR__ . '/search_input.php'; ?>
				</div>
				<div class="mt-3 mb-3 d-flex justify-content-between">
					<a class="btn btn-outline-success " href="./orderList-admin.php">返回列表</a>
					<div class="row">
						<div class="col"><span> 總筆數 : <?= $rowCount ?></span></div>
					</div>
				</div>
				<table class="table table-bordered table-striped">
					<tr>
						<th>訂單狀態</th>
						<th>交易編號</th>
						<th>訂購人姓名</th>
						<th>總金額</th>
						<th>付費方式</th>
						<th>付費狀態</th>
						<th>送貨方式</th>
						<th>送貨狀態</th>
						<th>送貨地址</th>
						<th>送貨日期</th>
						<th>下單日期</th>
						<th><i class="fa-solid fa-pen-to-square"></i></th>
						<th><i class="fa-solid fa-trash"></i></th>
					</tr>
					<?php
					foreach ($rows as $row) {
						echo '<tr>';
						echo '<td>', $row['order_status'], '</td>';
						echo '<td><a href="order_detail.php?transaction_id=' . htmlentities($row['transaction_id']) . '">', $row['transaction_id'], '</a></td>';
						echo '<td>', $row['purchaser_name'], '</td>';
						echo '<td>', $row['total_amount'], '</td>';
						echo '<td>', $row['payment_method'], '</td>';
						echo '<td>', $row['payment_status'], '</td>';
						echo '<td>', $row['shipping_method'], '</td>';
						echo '<td>', $row['shipping_status'], '</td>';
						echo '<td>', $row['shipping_address'], '</td>';
						echo '<td>', $row['shipping_date'], '</td>';
						echo '<td>', $row['order_date'], '</td>';
						echo '<td><a href="edit.php?order_id=', $row['order_id'], '" class="', $isAbled ,'"><i class="fa-solid fa-pen-to-square"></i></a></td>';
						echo '<td><a href="javascript:deleteOne(', $row['order_id'], ')"  class="', $isAbled ,'"><i class="fa-solid fa-trash  text-danger"></i></a></td>';
						echo '</tr>';
						echo "\n";
					}
					?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<?php include '../parts/html-foot.php' ?>