<?php 
require __DIR__ . '/parts/pdo-connect.php';
$title = '編輯訂單';
$pageName = 'orderList';

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if (empty($order_id)) {
    header('Location: orderList.php');
    exit;
}
$row = $pdo->query("SELECT * FROM `order` WHERE order_id=$order_id")->fetch();

?>

<?php include '../parts/html-head.php' ?>
<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>

<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>
<div class="m-4">
    <div class="row d-flex justify-content-center">
        <div class="col-6">
        <div class="bg-secondary rounded h-100 p-4 w-100">
                <div class="card-body">
                    <h5 class="card-title">編輯訂單</h5>
                    <form name="form1" onsubmit="sendData(event)">
                        <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                        <div class="mb-3">
                            <label for="transaction_id" class="form-label">交易編號</label>
                            <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="<?= $row['transaction_id'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="order_status" class="form-label">訂單狀態</label>
                            <select class="form-select" aria-label="Default select example" id="order_status" name="order_status">
                                <option selected><?= $row['order_status'] ?></option>
                                <option value="處理中">處理中</option>
                                <option value="完成">完成</option>
                                <option value="取消">取消</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="purchaser_name" class="form-label">訂購人姓名</label>
                            <input type="text" class="form-control" id="purchaser_name" name="purchaser_name" value="<?= $row['purchaser_name'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="purchaser_mobile" class="form-label">訂購人手機號碼</label>
                            <input type="text" class="form-control" id="purchaser_mobile" name="purchaser_mobile" value="<?= $row['purchaser_mobile'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="purchaser_email" class="form-label">訂購人email</label>
                            <input type="text" class="form-control" id="purchaser_email" name="purchaser_email" value="<?= $row['purchaser_email'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="recipient_name" class="form-label">收件人姓名</label>
                            <input type="text" class="form-control" id="recipient_name" name="recipient_name" value="<?= $row['recipient_name'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="recipient_mobile" class="form-label">收件人手機號碼</label>
                            <input type="text" class="form-control" id="recipient_mobile" name="recipient_mobile" value="<?= $row['recipient_mobile'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="shipping_method" class="form-label">送貨方式</label>
                            <input type="text" class="form-control" id="shipping_method" name="shipping_method" value="<?= $row['shipping_method'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">送貨地址</label>
                            <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="<?= $row['shipping_address'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">付費方式</label>
                            <input type="text" class="form-control" id="payment_method" name="payment_method" value="<?= $row['payment_method'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="payment_status" class="form-label">付費狀態</label>
                            <select class="form-select" aria-label="Default select example" id="payment_status" name="payment_status">
                                <option selected><?= $row['payment_status'] ?></option>
                                <option value="已付款">已付款</option>
                                <option value="未付款">未付款</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="invoice_type" class="form-label">發票類型</label>
                            <input type="text" class="form-control" id="invoice_type" name="invoice_type" value="<?= $row['invoice_type'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="invoice_code" class="form-label">手機條碼 / 捐贈碼 /統一編號</label>
                            <input type="text" class="form-control" id="invoice_code" name="invoice_code" value="<?= $row['invoice_code'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="company_title" class="form-label">公司抬頭</label>
                            <input type="text" class="form-control" id="company_title" name="company_title" value="<?= $row['company_title'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="shipping_status" class="form-label">送貨狀態</label>
                            <select class="form-select" aria-label="Default select example" id="shipping_status" name="shipping_status">
                                <option selected><?= $row['shipping_status'] ?></option>
                                <option value="已出貨">已出貨</option>
                                <option value="未出貨">未出貨</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="order_date" class="form-label">下單日期</label>
                            <input type="text" class="form-control" id="order_date" name="order_date" value="<?= $row['order_date'] ?>" disabled>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="shipping_date" class="form-label">出貨日期</label>
                            <input type="text" class="form-control" value="<?= $row['shipping_date'] ?>" disabled>
                            <input type="datetime-local" class="form-control" id="shipping_date" name="shipping_date" value="<?= $row['shipping_date'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">修改</button>
                        <a href="javascript:location.href=document.referrer"><button type="button" class="btn btn-primary">不修改並返回列表</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Boo的 alert Modal success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">編輯結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    修改成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <a href="javascript:location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
            </div>
        </div>
    </div>
</div>

<!--Boo的 alert Modal failed -->
<div class="modal fade" id="failModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">編輯結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    修改失敗
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <a href="javascript:location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
            </div>
        </div>
    </div>
</div>

<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<script>
    const {
        purchaser_name: nameEl,
        purchaser_mobile: mobileEl,
        purchaser_email: emailEl,
    } = document.form1;

    function sendData(event) {
        event.preventDefault();
        nameEl.style.border = "2px solid #CCC";
        nameEl.nextElementSibling.innerHTML = "";
        emailEl.style.border = "2px solid #CCC";
        emailEl.nextElementSibling.innerHTML = "";
        mobileEl.style.border = "2px solid #CCC";
        mobileEl.nextElementSibling.innerHTML = "";
        let isPass = true;
        if (isPass) {
            const fd = new FormData(document.form1);
            fetch('edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(result => {
                    console.log(result);
                    if (result.success) {
                        successModal.show()
                    } else {
                        if (result.error) {
                            failInfo.innerHTML = result.error;
                        } else {
                            failInfo.innerHTML = '資料修改失敗';
                        }
                        failModal.show();
                    }
                })
                .catch(error => {
                    if (error instanceof SyntaxError) {
                        // 非 JSON 格式的回應
                        console.error('非 JSON 格式的回應', error);
                        failInfo.innerHTML = '資料修改錯誤，返回的內容不是有效的 JSON 格式。';
                    } else {
                        // 其他錯誤
                        console.error('資料修改錯誤', error);
                        failInfo.innerHTML = '資料修改錯誤，請查看控制台以獲取更多信息。';
                    }
                    failModal.show();
                })
        }
    }
    const successModal = new bootstrap.Modal('#successModal');
    const failModal = new bootstrap.Modal('#failModal');
    const failInfo = document.querySelector('#failModal .alert-danger');
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>