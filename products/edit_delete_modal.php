<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">Edit </h4>
				</center>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
				<!-- <div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">picture:</label>
						</div>
						<div class="col-sm-10">
							<form name="form1" id="form1">
								<input type="file" name="picture" accept="image/jpeg,image/png" />
								<br />
								<input type="submit" form="form1" />
							</form>
							<br />
							<img src="" alt="" id="mypic1" width="300" />
							<br />
						</div>
					</div> -->
					<form method="POST" action="edit.php"form="form2">
						<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">product_Id:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="product_Id" value="<?php echo $row['product_Id']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">product:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="product" value="<?php echo $row['product']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">price:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">title:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">description:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="description" value="<?php echo $row['description']; ?>">
							</div>
						</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> 取消</button>
				<button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> 更新</a>
					</form>
			</div>

		</div>
	</div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">Delete</h4>
				</center>
			</div>
			<div class="modal-body">
				<p class="text-center">確認刪除</p>
				<h2 class="text-center"><?php echo $row['product_Id'] . ' ' . $row['product']. ' ' . $row['price'] .' '. $row['title'] .' '. $row['description'];  ?></h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> 取消</button>
				<a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 確認</a>
			</div>

		</div>
	</div>
</div>
<!-- <script>
	const mypic1 = document.querySelector("#mypic1");
	const filename1 = document.querySelector("#filename1");
	document.querySelector("#form1").addEventListener("submit", (e) => {
		e.preventDefault();
		const fd = new FormData(document.form1);
		fetch("./upload-picture.php", {
				method: "POST",
				body: fd,
			})
			.then((r) => r.json())
			.then((result) => {
				if (result.success) {
					// alert('上傳成功');
					mypic1.src = "./uploads/" + result.file;
					filename1.value = result.file;
				} else {
					alert("上傳失敗");
				}
			});
	})
</script> -->