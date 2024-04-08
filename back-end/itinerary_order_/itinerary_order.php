<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Group3-order_group</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
		.height10 {
			height: 10px;
		}

		.mtop10 {
			margin-top: 10px;
		}

		.modal-label {
			position: relative;
			top: 7px
		}
	</style>
</head>

<body>
	<div class="container">
		<h1 class="page-header text-center">套裝行程-訂單管理</h1>
		<div class="row">
			<div class="col">
				<div class="row">
					<?php
					if (isset($_SESSION['error'])) {
						echo
							"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['error'] . "
					</div>
					";
						unset($_SESSION['error']);
					}
					if (isset($_SESSION['success'])) {
						echo
							"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['success'] . "
					</div>
					";
						unset($_SESSION['success']);
					}
					?>
				</div>
				<div class="row">
					<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span
							class="glyphicon glyphicon-plus"></span> 新增</a>
				</div>
				<div class="height10">
				</div>
				<div class="row">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
							<th>訂單ID</th>
							<th>行程ID</th>
							<th>訂單金額</th>
							<th>訂金</th>
							<th>訂金付款日期/期限</th>
							<th>尾款金額</th>
							<th>尾款付款日期/期限</th>
							<th>付款方式</th>
							<th>處理狀態</th>
							<th>訂單建立時間</th>
							<th>訂單修改時間</th>
							<th>會員ID</th>
							<th>交易ID(積分)</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php
							include_once('connection.php');
							$sql = "SELECT * FROM order_group";

							//use for MySQLi-OOP
							$query = $conn->query($sql);
							while ($row = $query->fetch_assoc()) {
								echo
									"<tr>
									<td>" . $row['order_group_id'] . "</td>
									<td>" . $row['travel_id'] . "</td>
									<td>" . $row['amount'] . "</td>
									<td>" . $row['deposit'] . "</td>
									<td>" . $row['deposit_date'] . "</td>
									<td>" . $row['final_payment'] . "</td>
									<td>" . $row['final_payment_date'] . "</td>
									<td>" . $row['pay'] . "</td>
									<td>" . $row['information'] . "</td>
									<td>" . $row['created_at'] . "</td>
									<td>" . $row['edited_at'] . "</td>
									<td>" . $row['member_id'] . "</td>
									<td>" . $row['detail_id'] . "</td>
									<td>
										<a href='#edit_" . $row['order_group_id'] . "' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> 編輯</a>
										<a href='#delete_" . $row['order_group_id'] . "' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> 刪除</a>
									</td>
								</tr>";
								include('edit_delete_modal.php');
							}



							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php include('add_modal.php') ?>

	<script src="jquery/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="datatable/jquery.dataTables.min.js"></script>
	<script src="datatable/dataTable.bootstrap.min.js"></script>
	<!-- generate datatable on our table -->
	<script>
		$(document).ready(function () {
			//inialize datatable 具有排序、搜尋等功能的互動式表格
			$('#myTable').DataTable();

			//hide alert
			$(document).on('click', '.close', function () {
				$('.alert').hide();
			})
		});
	</script>
</body>
</html>