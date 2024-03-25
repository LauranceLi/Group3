<?php
require '../parts/form_pdo-connect.php';
session_start();
$isAbled = $_SESSION['permission']['form'] == 'view' ? 'disabled' : '';
if ($_SESSION['permission']['form']=='noAuthority'){
    header('Location: ../index.php');
    exit;
}
$title = "講座表單";
$pageName = 'speechForm';

?>
<?php include '../parts/html-head.php' ?>
<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>


<!-- 點列表LIST出現的部分 -->
<div class="container-fluid pt-4 px-4" id="pills-tabContent">
    <!-- 新增區 -->
    <div class="tab-pane" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 ">
                    <div class="bg-secondary rounded h-100 p-4 ">
                        <div class="card-body">
                            <h5 class="card-title text-center">新增講座資料</h5>

                            <form name="form1" onsubmit="sendData(event)">

                                <div class="mb-2 ">
                                    <label for="group_id" class="form-label">團體行程 I D</label>
                                    <input type="text" class="form-control" id="group_id" name="group_id">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="speechtime" class="form-label">講座時間</label>
                                    <input type="datetime-local" class="form-control" id="speechtime" name="speechtime">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="speechplace" class="form-label">講座地點</label>
                                    <input type="text" class="form-control" id="speechplace" list="datalistOptions speechplace" name="speechplace">
                                    <datalist id="datalistOptions speechplace">
                                        <option value="台北市內湖區洲子街72號一樓">
                                        <option value="台中市綠川西街85號10樓">
                                        <option value="台南市中西區衛民街67-1號">
                                        <option value="高雄市新興區民生一路56號B1-1">
                                    </datalist>
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="speechtell" class="form-label">講座連絡電話</label>
                                    <input type="text" class="form-control" id="speechtell" list="datalistOptions speechtell" name="speechtell">
                                    <datalist id="datalistOptions speechtell">
                                        <option value="02-66041922">
                                    </datalist>
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="speechname" class="form-label">講師名</label>
                                    <input type="text" class="form-control" id="speechname" list="datalistOptions speechname" name="speechname">
                                    <datalist id="datalistOptions speechname">
                                        <option value="游國珍">
                                        <option value="歐洲旅遊達人Daniel">
                                        <option value="柯彩雲 Tessa">
                                        <option value="Carol（汪淑媛）">
                                        <option value="蘇昭旭">
                                        <option value="黃忠勤-法國國家藝術導覽員">
                                        <option value="玩美南人/Eric苗啟誠">
                                    </datalist>
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="speechpeoplelimit" class="form-label">參加人數限制</label>
                                    <input type="text" class="form-control" list="datalistOptions speechpeoplelimit" id="speechpeoplelimit" name="speechpeoplelimit">
                                    <datalist id="datalistOptions speechpeoplelimit">
                                        <option value="10">
                                        <option value="20">
                                        <option value="25">
                                        <option value="30">

                                    </datalist>
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="country" class="form-label">國家</label>
                                    <input type="text" class="form-control" list="datalistOptions country" id="country" name="country">
                                    <datalist id="datalistOptions country">
                                        <option value="南極">
                                        <option value="葡萄牙">
                                        <option value="法國">
                                        <option value="摩洛哥">
                                        <option value="阿根廷">
                                        <option value="古巴">
                                        <option value="日本">
                                        <option value="奧地利">
                                        <option value="法國">
                                        <option value="伊比利半島">
                                        <option value="秘魯">
                                    </datalist>
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="introduction" class="form-label">國家介紹</label>
                                    <textarea class="form-control" id="floatingTextarea2" name="introduction" style="height: 100px"></textarea>
                                    <div class="form-text"></div>
                                </div>
                                <button type="submit" class="btn btn-primary" <?= $isAbled ?>>送出</button>
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
            <div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            if (speechtimeField.value === '') {
                isPass = false;
                speechtimeField.style.border = "2px solid red";
                speechtimeField.nextElementSibling.innerHTML = '請輸入講座時間';
            }
            //speechplace必填，檢查格式，空白錯誤
            if (speechplaceField.value === '') {
                isPass = false;
                speechplaceField.style.border = "2px solid red";
                speechplaceField.nextElementSibling.innerHTML = '請輸入講座地點';
            }
            //speechtell必填，檢查格式，空白錯誤
            if (speechtellField.value === '') {
                isPass = false;
                speechtellField.style.border = "2px solid red";
                speechtellField.nextElementSibling.innerHTML = '請輸入講座的聯繫電話';
            }
            //speechname必填，檢查格式，空白錯誤
            if (speechnameField.value === '') {
                isPass = false;
                speechnameField.style.border = "2px solid red";
                speechnameField.nextElementSibling.innerHTML = '請輸入講座講師名字';
            }
            //speechpeoplelimit必填，檢查格式，空白錯誤
            if (speechpeoplelimitField.value === '') {
                isPass = false;
                speechpeoplelimitField.style.border = "2px solid red";
                speechpeoplelimitField.nextElementSibling.innerHTML = '請輸入講座人數上限數量';
            }
            //country必填，檢查格式，空白錯誤
            if (countryField.value === '') {
                isPass = false;
                countryField.style.border = "2px solid red";
                countryField.nextElementSibling.innerHTML = '請輸入國家名';
            }
            //introduction必填，檢查格式，空白錯誤
            if (introductionField.value === '') {
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
                fetch('speech_add_api.php', {
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

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
    </script>

    <?php include '../parts/html-foot.php' ?>