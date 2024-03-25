<?php
require '../parts/form_pdo-connect.php';
session_start();
$isAbled = $_SESSION['permission']['form'] == 'view' ? 'disabled' : '';
if ($_SESSION['permission']['form']=='noAuthority'){
    header('Location: ../index.php');
    exit;
}
$title = "客製化表單";
$pageName = 'customizationForm';

?>
<?php include '../parts/html-head.php' ?>
<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>


<!-- 點列表LIST出現的部分 -->
<div class="container-fluid pt-4 px-4" id="pills-tabContent">

    <!-- 新增區 -->
    <div class="tab-pane" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

        <div class="row justify-content-center">
            <div class="col-6 ">
                <div class="bg-secondary rounded h-100 p-4 ">
                    <div class="card-body">
                        <h5 class="card-title text-center">新增客製化表單</h5>

                        <form name="form1" onsubmit="sendData(event)">

                            <div class="mb-2 ">
                                <label for="name" class="form-label">姓名</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-2 ">
                                <label for="mobile" class="form-label">手機號碼</label>
                                <input type="text" class="form-control" id="mobile" name="mobile">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-2 ">
                                <label for="email" class="form-label">信箱</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-2 ">
                                <label for="place" class="form-label">地點</label>
                                <input type="text" class="form-control" list="datalistOptions place" id="place" name="place">
                                <datalist id="datalistOptions place">
                                    <option value="南極">
                                    <option value="葡萄牙">
                                    <option value="法國">
                                    <option value="摩洛哥">
                                    <option value="阿根廷">
                                    <option value="古巴">
                                    <option value="日本">
                                    <option value="奧地利">
                                    <option value="法國">
                                    <option value="台灣">
                                    <option value="伊比利半島">
                                    <option value="秘魯">
                                </datalist>
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-2 ">
                                <label for="transportation" class="form-label">航空公司</label>
                                <input type="text" class="form-control" id="transportation" list="datalistOptions transportation" name="transportation">
                                <datalist id="datalistOptions transportation">
                                    <option value="中華航空">
                                    <option value="淩天航空">
                                    <option value="星宇航空">
                                    <option value="長榮航空">
                                    <option value="立榮航空">
                                    <option value="德安航空">
                                </datalist>
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-2 ">
                                <label for="budget" class="form-label">預算</label>
                                <input type="text" class="form-control" id="budget" name="budget">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-2 ">
                                <label for="calltime" class="form-label">聯絡時間</label>
                                <input type="date" class="form-control" id="calltime" name="calltime">
                                <div class="form-text"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">輸入</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <!-- 跳出訊息框-成功 -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5">訊息提示</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-success" role="alert">資料新增成功</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    <a href="javascript: location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 跳出訊息框-失敗 -->
    <div class="modal fade" id="failModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5">訊息提示</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger" role="alert">資料新增失敗</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button><a href="javascript: location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<script>
    const {
        name: nameField,
        mobile: mobileField,
        email: emailField,
        place: placeField,
        transportation: transportationField,
        budget: budgetField,
        calltime: calltimeField
    } = document.form1;


    function sendData(e) {

        // 欄位的外觀要回復原來的狀態
        nameField.style.border = "1px solid #CCC";
        nameField.nextElementSibling.innerHTML = '';
        mobileField.style.border = "1px solid #CCC";
        mobileField.nextElementSibling.innerHTML = '';
        emailField.style.border = "1px solid #CCC";
        emailField.nextElementSibling.innerHTML = '';
        placeField.style.border = "1px solid #CCC";
        placeField.nextElementSibling.innerHTML = '';
        transportationField.style.border = "1px solid #CCC";
        transportationField.nextElementSibling.innerHTML = '';
        budgetField.style.border = "1px solid #CCC";
        budgetField.nextElementSibling.innerHTML = '';
        calltimeField.style.border = "1px solid #CCC";
        calltimeField.nextElementSibling.innerHTML = '';

        e.preventDefault(); //不要讓表單以傳統的方式送出

        // 判斷有無通過檢查，預true，紅框+套入正規化
        let isPass = true;
        //name 必填，檢查格式，空白錯誤
        if (!/^[\u4e00-\u9fa5]{2,3}$/.test(nameField.value.trim()) || nameField.value === '') {
            isPass = false;
            nameField.style.border = "2px solid red";
            nameField.nextElementSibling.innerHTML = '請輸入正確的中文名字字數';
        }
        // mobile 必填，檢查格式，空白錯誤
        if (mobileField.value.lenght < 9 || !validatemobile(mobileField.value) || mobileField.value === '' || !/^\d+$/.test(mobileField.value)) {
            isPass = false;
            mobileField.style.border = "2px solid red";
            mobileField.nextElementSibling.innerHTML = '請輸入正確的手機號碼(09........)';
        }
        // email 必填，檢查格式，空白錯誤
        if (emailField.value === '' || !validateEmail(emailField.value)) {
            isPass = false;
            emailField.style.border = "2px solid red";
            emailField.nextElementSibling.innerHTML = '請輸入正確的 Email 格式';
        }
        //place必填，空白錯誤
        if (placeField.value === '') {
            isPass = false;
            placeField.style.border = "2px solid red";
            placeField.nextElementSibling.innerHTML = '請填寫國家名';
        }
        // transportation 必填，空白錯誤
        if (transportationField.value === '') {
            isPass = false;
            transportationField.style.border = "2px solid red";
            transportationField.nextElementSibling.innerHTML = '請輸入航空公司名稱';
        }
        // budget 必填，空白錯誤
        if (budgetField.value === '') {
            isPass = false;
            budgetField.style.border = "2px solid red";
            budgetField.nextElementSibling.innerHTML = '必填項目';
        }
        // calltime 必填，空白錯誤
        if (calltimeField.value === '') {
            isPass = false;
            calltimeField.style.border = "2px solid red";
            calltimeField.nextElementSibling.innerHTML = '必填項目';
        }

        // 正規化區塊
        //mobile 檢查格式
        function validatemobile(mobile) {
            const pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
            return pattern.test(mobile);
        }
        //email 檢查格式
        function validateEmail(email) {
            const re =
                /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        //如有欄位有通過，才發送AJAX
        if (isPass) {

            const fd = new FormData(document.form1); // 看成沒有外觀的表單-傳至後端
            fetch('customization_add_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(result => {
                    console.log(result);
                    if (result.success) {
                        // alert('資料新增成功')
                        successModal.show();
                    } else {
                        // alert('資料新增失敗')
                        if (result.error) {
                            failureInfo.innerHTML = result.error;
                        } else {
                            failureInfo.innerHTML = '資料新增沒有成功';
                        }
                        failureModal.show();
                    }
                })
                .catch(ex => {
                    // alert('資料新增發生錯誤' + ex)
                    failureInfo.innerHTML = '資料新增發生錯誤' + ex;
                    failureModal.show();
                })
        }
    }
    const successModal = new bootstrap.Modal('#successModal');
    const failureModal = new bootstrap.Modal('#failureModal');
    const failureInfo = document.querySelector('#failureModal .alert-danger');
</script>
<?php include '../parts/html-foot.php' ?>