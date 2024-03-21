<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Group3-travel</title>
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

		.row {
			margin-left: -30px;
		}
	</style>
</head>

<body>
	<div class="container">
		<h1 class="page-header text-center">套裝行程管理</h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
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
							<th>ID</th>
							<th>圖片</th>
							<th>行程標題</th>
							<th>行程簡介</th>
							<th>天數</th>
							<th>售價</th>
							<th>出發日期</th>
							<th>出發地</th>
							<th>機位數量</th>
							<th>已報名人數</th>
							<th>可售機位</th>
							<th>出團狀態</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php
							include_once('connection.php');
							$sql = "SELECT * FROM travel_";

							//use for MySQLi-OOP
							$query = $conn->query($sql);
							while ($row = $query->fetch_assoc()) {
								echo
									"<tr>
									<td>" . $row['travel_id'] . "</td>
									<td><img src='uploads/" . $row['logo'] . "'></td>
									<td>" . $row['title'] . "</td>
									<td>" . $row['introduce'] . "</td>
									<td>" . $row['days'] . "</td>
									<td>" . $row['price'] . "</td>
									<td>" . $row['time'] . "</td>
									<td>" . $row['airport'] . "</td>
									<td>" . $row['seat'] . "</td>
									<td>" . $row['number'] . "</td>
									<td>" . $row['sale'] . "</td>
									<td>" . $row['sign_up'] . "</td>
									<td>
										<a href='#edit_" . $row['travel_id'] . "' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> 編輯</a>
										<a href='#delete_" . $row['travel_id'] . "' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> 刪除</a>
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