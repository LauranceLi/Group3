<?php require __DIR__ . '/parts/pdo-connect.php';
?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
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
?>

<div class="container">
	<div class="row">
		<div class="col mt-3">
			<?php include __DIR__ . '/filter.php'; ?>
			<?php include __DIR__ . '/search_input.php'; ?>
			<div class="mt-3">
				<a class="btn btn-primary" href="./list-admin.php">返回列表</a>
			</div>
			<table class="table table-bordered table-striped  mt-3">
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
					<th><i class="fa-solid fa-file-pen"></i></th>
					<th><i class="fa-solid fa-trash"></i></th>
				</tr>
				<?php
				foreach ($sql->fetchAll() as $row) {
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
					echo '<td><a href="edit.php?order_id=', $row['order_id'], '"><i class="fa-solid fa-file-pen"></i></a></td>';
					echo '<td><a href="javascript:deleteOne(', $row['order_id'], ')"><i class="fa-solid fa-trash"></i></a></td>';
					echo '</tr>';
					echo "\n";
				}
				?>
			</table>
		</div>
	</div>
</div>
<?php include __DIR__ . '/parts/html-foot.php' ?>