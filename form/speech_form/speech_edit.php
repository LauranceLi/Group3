<?php

include __DIR__ . '/speech_navbar.php';  #主要欄位
require __DIR__ . '/speech_pdo-connect.php'; #附上資料庫連結
$title = '編輯通訊列表';
$pageName = 'edit';

// 編輯，去篩選sid，亂輸入
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: speech_list.php');
    exit;
}
//有資料就繼續，跟本不存在的資料
$r = $pdo->query("SELECT * FROM speech_list WHERE sid=$sid")->fetch();
if (empty($r)) {
    header('Location: speech_list.php');
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
                    <h5 class="card-title">編輯講座資料</h5>

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
                            <label for="speechtime" class="form-label">講座時間</label>
                            <input type="datetime-local" class="form-control" id="speechtime" name="speechtime" value="<?= $r['speechtime'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="speechplace" class="form-label">講座地址</label>
                            <input type="text" class="form-control" id="speechplace" name="speechplace" value="<?= $r['speechplace'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="speechtell" class="form-label">講座聯絡電話</label>
                            <input type="text" class="form-control" id="speechtell" name="speechtell" value="<?= $r['speechtell'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="speechname" class="form-label">講師</label>
                            <input type="text" class="form-control" id="speechname" name="speechname" value="<?= $r['speechname'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="speechpeoplelimit" class="form-label">參加人數上限</label>
                            <input type="text" class="form-control" id="speechpeoplelimit" name="speechpeoplelimit" value="<?= $r['speechpeoplelimit'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">國家</label>
                            <input type="text" class="form-control" id="country" name="country" value="<?= $r['country'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="introduction" class="form-label">介紹</label>
                            <input type="text" class="form-control" id="introduction" name="introduction" value="<?= $r['introduction'] ?>">
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
        speechtime: speechtimeField,
        speechplace: speechplaceField,
        speechtell: speechtellField,
        speechname: speechnameField,
        speechpeoplelimit: speechpeoplelimitField,
        country: countryField,
        introduction: introductionField
    } = document.form1;


    function sendData(e) {

        // 欄位的外觀要回復原來的狀態
        groupidField.style.border = "1px solid #CCC";
        groupidField.nextElementSibling.innerHTML = '';
        speechtimeField.style.border = "1px solid #CCC";
        speechtimeField.nextElementSibling.innerHTML = '';
        speechplaceField.style.border = "1px solid #CCC";
        speechplaceField.nextElementSibling.innerHTML = '';
        speechtellField.style.border = "1px solid #CCC";
        speechtellField.nextElementSibling.innerHTML = '';
        speechnameField.style.border = "1px solid #CCC";
        speechnameField.nextElementSibling.innerHTML = '';
        speechpeoplelimitField.style.border = "1px solid #CCC";
        speechpeoplelimitField.nextElementSibling.innerHTML = '';
        countryField.style.border = "1px solid #CCC";
        countryField.nextElementSibling.innerHTML = '';
        introductionField.style.border = "1px solid #CCC";
        introductionField.nextElementSibling.innerHTML = '';

        e.preventDefault(); //不要讓表單以傳統的方式送出

        // 判斷有無通過檢查，預true，紅框+套入正規化
        let isPass = true;
        //groupid必填，檢查格式，空白錯誤
        if (!validategroup_id(groupidField.value) || groupidField.value === '' || !/^\d+$/.test(groupidField.value) ||
            !(parseInt(groupidField.value) >= 0 && parseInt(groupidField.value) <= 99)) {
            isPass = false;
            groupidField.style.border = "2px solid red";
            groupidField.nextElementSibling.innerHTML = '請輸入正確的行程編號(1~99)';
        }
        //speechtime必填，檢查格式，空白錯誤
        if (speechtimeField.value === '' ) {
            isPass = false;
            speechtimeField.style.border = "2px solid red";
            speechtimeField.nextElementSibling.innerHTML = '請輸入講座時間';
        }
        //speechplace必填，檢查格式，空白錯誤
        if (speechplaceField.value === '' ) {
            isPass = false;
            speechplaceField.style.border = "2px solid red";
            speechplaceField.nextElementSibling.innerHTML = '請輸入講座地點';
        }
        //speechtell必填，檢查格式，空白錯誤
        if (speechtellField.value === '' ) {
            isPass = false;
            speechtellField.style.border = "2px solid red";
            speechtellField.nextElementSibling.innerHTML = '請輸入講座的聯繫電話';
        }
        //speechname必填，檢查格式，空白錯誤
        if (speechnameField.value === '' ) {
            isPass = false;
            speechnameField.style.border = "2px solid red";
            speechnameField.nextElementSibling.innerHTML = '請輸入講座講師名字';
        }
        //speechpeoplelimit必填，檢查格式，空白錯誤
        if (speechpeoplelimitField.value === '' ) {
            isPass = false;
            speechpeoplelimitField.style.border = "2px solid red";
            speechpeoplelimitField.nextElementSibling.innerHTML = '請輸入講座人數上限數量';
        }
        //country必填，檢查格式，空白錯誤
        if (countryField.value === '' ) {
            isPass = false;
            countryField.style.border = "2px solid red";
            countryField.nextElementSibling.innerHTML = '請輸入國家名';
        }
        //introduction必填，檢查格式，空白錯誤
        if (introductionField.value === '' ) {
            isPass = false;
            introductionField.style.border = "2px solid red";
            introductionField.nextElementSibling.innerHTML = '請輸入國家行程的介紹';
        }

        // 正規化區塊
        //group_id 檢查格式
        function validategroup_id(group_id) {
            const groupid =
                /^(0|[1-9]|[1-9][0-9]?)$/;
            return groupid.test(group_id);
        }

        //如有欄位有通過，才發送AJAX
        if (isPass) {

            const fd = new FormData(document.form1); // 看成沒有外觀的表單-傳至後端
            fetch('speech_edit_api.php', {
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
<?php include __DIR__ . '/../part/html-foot.php'; ?>