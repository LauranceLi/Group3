<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">新增訂單</h4>
				</center>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="add.php">
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">行程編號:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="travel_id" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">訂單金額:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="amount" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">訂金:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="deposit" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">訂金付款日期/期限:</label>
							</div>
							<div class="col-sm-10">
								<input type="date" class="form-control" name="deposit_date" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">尾款金額:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="final_payment" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">尾款付款日期/期限:</label>
							</div>
							<div class="col-sm-10">
								<input type="date" class="form-control" name="final_payment_date" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-10">
								<label for="pay">付款方式：</label>
								<select name="pay" id="pay">
									<option value="轉帳">轉帳</option>
									<option value="信用卡">信用卡</option>
								</select>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-sm-10">
								<label for="information">處理狀態：</label>
								<select name="information" id="information">
									<option value="尚未付款">尚未付款</option>
									<option value="等待收取尾款">等待收取尾款</option>
									<option value="等待出團 (已收尾款確定出團)">等待出團 (已收尾款確定出團)</option>
									<option value="完成 (已出團)">完成 (已出團)</option>
									<option value="取消">取消</option>
								</select>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">會員ID:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="member_id" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">交易ID(積分明細):</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="detail_id" required>
							</div>
						</div>


				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span
						class="glyphicon glyphicon-remove"></span> 取消</button>
				<button type="submit" name="add" class="btn btn-primary"><span
						class="glyphicon glyphicon-floppy-disk"></span> 新增</a>
					</form>
			</div>

		</div>
	</div>
</div>