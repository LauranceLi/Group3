<?php 
require __DIR__ . '/parts/pdo-connect.php';

$title = '新增訂單';
$pageName = 'orderList';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include '../parts/html-head.php' ?>
<style>
    form .mb-3 .form-text {
        color: red;
    }

    .radio {
        display: flex;
        justify-content: center;
    }

    .invioce,
    .payment_method,
    .shipping_method {
        margin: 10px 10px 10px 20px;
    }

    .hidden {
        display: none;
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
                    <h5 class="card-title">新增訂單</h5>
                    <form name="form1" onsubmit="sendData(event)">
                        <div class="mb-3">
                            <label for="purchaser_name" class="form-label">訂購人姓名</label>
                            <input type="text" class="form-control" id="purchaser_name" name="purchaser_name">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="purchaser_mobile" class="form-label">訂購人手機號碼</label>
                            <input type="text" class="form-control" id="purchaser_mobile" name="purchaser_mobile">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="purchaser_email" class="form-label">訂購人email</label>
                            <input type="text" class="form-control" id="purchaser_email" name="purchaser_email">
                            <div class="form-text"></div>
                        </div>
                        <button type="button" class="mb-3 btn btn-outline-success" id="same">同訂購人資料</button>
                        <div class="mb-3">
                            <label for="recipient_name" class="form-label">收件人姓名</label>
                            <input type="text" class="form-control" id="recipient_name" name="recipient_name">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="recipient_mobile" class="form-label">收件人手機號碼</label>
                            <input type="text" class="form-control" id="recipient_mobile" name="recipient_mobile">
                            <div class="form-text"></div>
                        </div>
                        <div>送貨方式</div>
                        <div class="radio">
                            <label for="shipping_method1" class="form-label shipping_method">超取</label>
                            <input type="radio" class="" id="shipping_method1" name="shipping_method" value="超取">
                            <div class="form-text"></div>
                            <label for="shipping_method2" class="form-label shipping_method">中華郵政</label>
                            <input type="radio" class="" id="shipping_method2" name="shipping_method" value="中華郵政">
                            <div class="form-text"></div>
                            <label for="shipping_method3" class="form-label shipping_method">宅配</label>
                            <input type="radio" class="" id="shipping_method3" name="shipping_method" value="宅配">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">送貨地址</label>
                            <input type="text" class="form-control" id="shipping_address" name="shipping_address">
                            <div class="form-text"></div>
                        </div>
                        <div>付費方式</div>
                        <div class="radio">
                            <label for="payment_method1" class="form-label payment_method">ATM轉帳</label>
                            <input type="radio" class="" id="payment_method1" name="payment_method" value="ATM轉帳">
                            <div class="form-text"></div>
                            <label for="payment_method3" class="form-label payment_method">LINE PAY</label>
                            <input type="radio" class="" id="payment_method3" name="payment_method" value="LINE PAY">
                            <div class="form-text"></div>
                            <label for="payment_method4" class="form-label payment_method">貨到付款</label>
                            <input type="radio" class="" id="payment_method4" name="payment_method" value="貨到付款">
                            <div class="form-text"></div>
                        </div>
                        <div>發票類型</div>
                        <div class="radio">
                            <label for="uniform_invoiceEletric" class="form-label invioce">手機條碼</label>
                            <input type="radio" class="" id="uniform_invoiceEletric" name="invoice_type" value="二聯電子發票">
                            <div class="form-text"></div>
                            <label for="uniform_invoiceTri" class="form-label invioce">三聯發票</label>
                            <input type="radio" class="" id="uniform_invoiceTri" name="invoice_type" value="三聯發票">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="invoice_code" class="form-label">手機載具條碼</label>
                            <input type="text" class="form-control" id="invoice_code" name="invoice_code">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 hidden" id="companyTitle">
                            <label for="company_title" class="form-label">抬頭統編</label>
                            <input type="text" class="form-control" id="company_title" name="company_title">
                            <div class="form-text"></div>
                        </div>
                        <input type="text" class="form-control" id="order_status" name="order_status" value="處理中" hidden>
                        <button type="submit" class="btn btn-primary" id="submit">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Boo的 alert Modal  -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">新增結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    新增成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <a href="orderList.php" class="btn btn-primary">跳到列表頁</a>
            </div>
        </div>
    </div>
</div>

<!--Boo的 alert Modal  -->
<div class="modal fade" id="failModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">新增結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    新增失敗
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <a href="list.php" class="btn btn-primary">跳到列表頁</a>
            </div>
        </div>
    </div>
</div>


<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<script>
    const {
        purchaser_name: nameEl,
        purchaser_email: emailEl,
        purchaser_mobile: mobileEl,
        recipient_name: recipient_nameEl,
        recipient_mobile: recipient_mobileEl,
        shipping_address: shipping_addressEl,
        invoice_code: invoice_codeEl,
    } = document.form1;
    document.querySelector('#same').addEventListener('click', () => {
        let name_value = document.querySelector('#purchaser_name').value;
        let mobile_value = document.querySelector('#purchaser_mobile').value;
        document.querySelector('#recipient_name').value = name_value;
        document.querySelector('#recipient_mobile').value = mobile_value;
    });

    function handleClick() {
        if (document.querySelector('#uniform_invoiceTri').checked) {
            companyTitle.classList.remove('hidden');
        } else {
            companyTitle.classList.add('hidden');
        }
    }
    document.querySelector('#uniform_invoiceTri').addEventListener('click', handleClick);
    let checkEls = document.querySelectorAll('input[type="radio"]');

    function checkForm() {
        event.preventDefault();
        if (!nameEl.value || !emailEl.value || !mobileEl.value ||
            !recipient_nameEl.value || !recipient_mobileEl.value ||
            !shipping_addressEl.value) {
            alert("所有項目都必須填寫！");
            return false;
        } else {
            let checkedCount = 0;
            checkEls.forEach(function(checkEl) {
                if (checkEl.checked) {
                    checkedCount++;
                }
            });
            if (checkedCount < 3) {
                event.preventDefault();
                alert("請選擇支付方式、送貨方式及發票類型！");
                return false;
            }
        }
        return true;
    };

    function validateEmail(email) {
        const re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validateMobile(mobile) {
        const pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
        return pattern.test(mobile);
    }

    function validateAddress(address) {
        const pattern = /(?<city>\D+[縣市])(?<district>\D+?(市區|鎮區|鎮市|[鄉鎮市區]))(?<others>.+)/
        return pattern.test(address);
    }

    function validateInvoice(invoiceCode) {
        const pattern = /^\/[0-9A-Z.+-]{7}$/
        return pattern.test(invoiceCode);
    }

    function sendData(event) {
        nameEl.style.border = "2px solid #CCC";
        nameEl.nextElementSibling.innerHTML = "";
        emailEl.style.border = "2px solid #CCC";
        emailEl.nextElementSibling.innerHTML = "";
        mobileEl.style.border = "2px solid #CCC";
        mobileEl.nextElementSibling.innerHTML = "";
        event.preventDefault();
        let isPass = true;
        if (nameEl.value.length < 2) {
            isPass = false;
            nameEl.style.border = "2px solid red";
            nameEl.nextElementSibling.innerHTML = "不可少於2個字";
        }
        if (!emailEl.value || !validateEmail(emailEl.value)) {
            isPass = false;
            emailEl.style.border = "2px solid red";
            emailEl.nextElementSibling.innerHTML = "請輸入正確的Email";
        }
        if (!mobileEl.value || !validateMobile(mobileEl.value)) {
            isPass = false;
            mobileEl.style.border = "2px solid red";
            mobileEl.nextElementSibling.innerHTML = "請輸入正確的手機號碼";
        }
        if (!shipping_addressEl.value || !validateAddress(shipping_addressEl.value)) {
            isPass = false;
            shipping_addressEl.style.border = "2px solid red";
            shipping_addressEl.nextElementSibling.innerHTML = "請輸入正確的送貨地址";
        }
        if (!invoice_codeEl.value || !validateInvoice(invoice_codeEl.value)) {
            isPass = false;
            invoice_codeEl.style.border = "2px solid red";
            invoice_codeEl.nextElementSibling.innerHTML = "請輸入正確的載具條碼";
        }
        if (!checkForm()) {
            isPass = false;
        }
        if (isPass) {
            const fd = new FormData(document.form1);
            fetch('add-api.php', {
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
                            failInfo.innerHTML = '資料錯誤';
                        }
                        failModal.show();
                    }
                })
                .catch(ex => {
                    failInfo.innerHTML = '資料錯誤....' + ex;
                    failModal.show();
                })
        }
    }
    const successModal = new bootstrap.Modal('#successModal');
    const failModal = new bootstrap.Modal('#failModal');
    const failInfo = document.querySelector('#failModal .alert-danger');
</script>
<?php include '../parts/html-foot.php' ?>