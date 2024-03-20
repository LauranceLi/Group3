<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">新增行程</h4>
				</center>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label modal-label">圖片:</label>
						</div>
						<div class="col-sm-10">
							<form name="form1" id="form1">
								<input type="file" name="avatar" accept="image/jpeg,image/png" />
								<br />
								<input type="submit" form="form1" />
							</form>
							<br />
							<img src="" alt="" id="myimg" width="300" />
							<br />
						</div>
					</div>
					<form method="POST" action="add.php" id="form2">
						<input type="hidden" id="filename" name="logo">

						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">行程標題:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label for="introduce" class="form-label">行程簡介:</label>
							</div>
							<div class="col-sm-10">
								<textarea class="form-control" name="introduce" id="introduce" cols="30" rows="3"></textarea>
								<div class="form-text"></div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">天數:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="days" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">售價:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="price" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">出發日期:</label>
							</div>
							<div class="col-sm-10">
								<input type="date" class="form-control" name="time" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-10">
								<label for="airport">出發地：</label>
								<select name="airport" id="airport">
									<option value="桃園國際機場">桃園國際機場</option>
									<option value="台北松山機場">台北松山機場</option>
									<option value="臺中國際機場">臺中國際機場</option>
									<option value="高雄小港機場">高雄小港機場</option>
								</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">機位數量:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="seat" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">已報名人數:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="number" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">可售機位:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="sale" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-10">
								<label for="sign_up">出團狀態：</label>
								<select name="sign_up" id="sign_up">
									<option value="報名中">報名中</option>
									<option value="額滿">額滿</option>
									<option value="截止">截止</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> 取消</button>
							<button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> 新增</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	const myimg = document.querySelector("#myimg");
	const filename = document.querySelector("#filename");
	document.querySelector("#form1").addEventListener("submit", (e) => {
		e.preventDefault();
		const fd = new FormData(document.form1);
		fetch("./upload-avatar.php", {
				method: "POST",
				body: fd,
			})
			.then((r) => r.json())
			.then((result) => {
				if (result.success) {
					// alert('上傳成功');
					myimg.src = "./uploads/" + result.file;
					filename.value = result.file;
				} else {
					alert("上傳失敗");
				}
			});
	})
</script>