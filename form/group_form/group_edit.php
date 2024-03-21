<?php

include __DIR__ . '/group_navbar.php';  #主要欄位
require __DIR__ . '/group_pdo-connect.php'; #附上資料庫連結
$title = '編輯通訊列表';
$pageName = 'edit';

// 編輯，去篩選sid，亂輸入
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: group_list.php');
    exit;
}
//有資料就繼續，跟本不存在的資料
$r = $pdo->query("SELECT * FROM group_list WHERE sid=$sid")->fetch();
if (empty($r)) {
    header('Location: group_list.php');
    exit;
}
?>
<?php include __DIR__ . '/../part/html-head.php'; ?>

<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯通訊錄</h5>

                    <form name="form1" onsubmit="sendData(event)">

                        <!-- 用戶看不到，後端傳送之後會看到 -->
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">

                        <!-- 顯示編輯的頁面 -->
                        <div class="mb-3">
                            <label for="sid" class="form-label">編號</label>
                            <input type="text" class="form-control" value="<?= $r['sid'] ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="group_id" class="form-label">團體行程 ID</label>
                            <input type="text" class="form-control" id="group_id" name="group_id" value="<?= $r['group_id'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $r['name'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">西元生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $r['birthday'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nameid" class="form-label">身分證字號</label>
                            <input type="text" class="form-control" id="nameid" name="nameid" value="<?= $r['nameid'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">信箱</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $r['email'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $r['mobile'] ?>">
                            <div class="form-text"></div>
                        </div>


                        <div class="mb-3">
                            <label for="address" class="form-label">地址</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $r['address'] ?>">
                            <div class="form-text"></div>
                        </div>


                        <button type="submit" class="btn btn-primary">修改</button>
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
                <div class="alert alert-success" role="alert">資料修改成功</div>
                <div class="modal-footer">
                    <a href="javascript: location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 跳出訊息框-失敗 -->
    <div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5">訊息提示</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger" role="alert">資料修改失敗</div>
                <div class="modal-footer">
                    <a href="javascript: location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    const {
        group_id: groupidField,
        name: nameField,
        nameid: nameidField,
        birthday: birthdayField,
        email: emailField,
        mobile: mobileField,
        address: addressField
    } = document.form1;




    function sendData(e) {

        // 欄位的外觀要回復原來的狀態
        groupidField.style.border = "1px solid #CCC";
        groupidField.nextElementSibling.innerHTML = '';
        nameField.style.border = "1px solid #CCC";
        nameField.nextElementSibling.innerHTML = '';
        nameidField.style.border = "1px solid #CCC";
        nameidField.nextElementSibling.innerHTML = '';
        birthdayField.style.border = "1px solid #CCC";
        birthdayField.nextElementSibling.innerHTML = '';
        emailField.style.border = "1px solid #CCC";
        emailField.nextElementSibling.innerHTML = '';
        mobileField.style.border = "1px solid #CCC";
        mobileField.nextElementSibling.innerHTML = '';
        addressField.style.border = "1px solid #CCC";
        addressField.nextElementSibling.innerHTML = '';

        e.preventDefault(); //不要讓表單以傳統的方式送出

        // 判斷有無通過檢查，預true
        let isPass = true;
        if (!validategroup_id(groupidField.value) || groupidField.value === '' || !/^\d+$/.test(groupidField.value) ||
            !(parseInt(groupidField.value) >= 0 && parseInt(groupidField.value) <= 99)) {
            isPass = false;
            groupidField.style.border = "2px solid red";
            groupidField.nextElementSibling.innerHTML = '請輸入正確的行程編號(1~99)';
        }
        //name 必填，檢查格式，空白錯誤
        if (!/^[\u4e00-\u9fa5]{2,3}$/.test(nameField.value.trim()) || nameField.value === '') {
            isPass = false;
            nameField.style.border = "2px solid red";
            nameField.nextElementSibling.innerHTML = '請輸入正確的中文名字字數';
        }
        // email 必填，檢查格式，空白錯誤
        if (emailField.value === '' || !validateEmail(emailField.value)) {
            isPass = false;
            emailField.style.border = "2px solid red";
            emailField.nextElementSibling.innerHTML = '請輸入正確的 Email 格式';
        }
        // mobile 必填，檢查格式，空白錯誤
        if (mobileField.value.lenght < 9 || !validateMobile(mobileField.value) || mobileField.value === '' || !/^\d+$/.test(mobileField.value)) {
            isPass = false;
            mobileField.style.border = "2px solid red";
            mobileField.nextElementSibling.innerHTML = '請輸入正確的手機號碼(09........)';
        }
        // nameid 必填，檢查格式，空白錯誤
        if (nameidField.value.lenght < 10 || !validateNameid(nameidField.value) || nameidField.value === '') {
            isPass = false;
            nameidField.style.border = "2px solid red";
            nameidField.nextElementSibling.innerHTML = '請輸入正確的身分證字號(英文必須大寫)';
        }
        // birthday 必填，空白錯誤
        if (birthdayField.value === '') {
            isPass = false;
            birthdayField.style.border = "2px solid red";
            birthdayField.nextElementSibling.innerHTML = '必填項目';
        }
        // address 必填，空白錯誤
        if (addressField.value === '') {
            isPass = false;
            addressField.style.border = "2px solid red";
            addressField.nextElementSibling.innerHTML = '必填項目';
        }

        // 正規化區塊
        //group_id 檢查格式
        function validategroup_id(group_id) {
            const groupid =
                /^(0|[1-9]|[1-9][0-9]?)$/;
            return groupid.test(group_id);
        }
        //nameid 檢查格式
        function validateNameid(nameid) {
            const nameidd = /^[A-Z][1-2]\d{8}$/;
            return nameidd.test(nameid);
        }
        //email 檢查格式
        function validateEmail(email) {
            const re =
                /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        //mobile 檢查格式
        function validateMobile(mobile) {
            const pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
            return pattern.test(mobile);
        }

        //如有欄位有通過，才發送AJAX
        if (isPass) {

            const fd = new FormData(document.form1); // 看成沒有外觀的表單-傳至後端

            fetch('group_edit_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(result => {
                    console.log(result);
                    if (result.success) {
                        // alert('資料修改成功')
                        successModal.show();
                    } else {
                        // alert('資料修改失敗')
                        if (result.error) {
                            failureInfo.innerHTML = result.error;
                        } else {
                            failureInfo.innerHTML = '資料修改沒有成功';
                        }
                        failureModal.show();
                    }
                })
                .catch(ex => {
                    // alert('資料新增發生錯誤' + ex)
                    failureInfo.innerHTML = '資料修改發生錯誤' + ex;
                    failureModal.show();
                })

        }

    }
    const successModal = new bootstrap.Modal('#successModal');
    const failureModal = new bootstrap.Modal('#failureModal');
    const failureInfo = document.querySelector('#failureModal .alert-danger');
</script>
<?php include __DIR__ . '/../part/html-foot.php'; ?>