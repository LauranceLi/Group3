<?php require __DIR__ . '/parts/pdo-connect.php';

$title = '登入';
$pageName = 'login';

if(isset($_SESSION['admin'])){
    header('Location: index_.php');
    exit;
}
?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<!-- 如果只有這個頁面要style效果可以放在下面 如果所有頁面都要style效果可以放在/parts/html-head.php 的檔案裏面-->
<style>
    /* 用空格尋找子元素   也可以用 > 代替 */
    form .mb-3 .form-text {
        color: red;
    }
</style>

<?php include __DIR__ . '/parts/navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">登入管理員</h5>
                    <form name="form1" onsubmit="sendData(event)">
                        <div class="mb-3">
                            <label for="email" class="form-label">email </label>
                            <input type="text" class="form-control" id="email" name="email">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password </label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">登入</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Boo的 alert Modal  -->
<div class="modal fade" id="failModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">登入失敗</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    帳號或密碼錯誤
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續登入</button>
            </div>
        </div>
    </div>
</div>



<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    //TODO:   檢查資料格式 前置 1.拿到要檢查的欄位
    const {
        email: emailEl,
        password: passwordEl
    } = document.form1;
    //設定檢查的格式
    function validateEmail(email) {
        const re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validateMobile(mobile) {
        const pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
        return pattern.test(mobile);
    }

    //function sendData(event 形式參數可以自定義) 自定義的函式 20240201-01-02有解釋
    function sendData(event) {
        //欄位回復原來的外觀
        emailEl.style.border = "2px solid #CCC";
        emailEl.nextElementSibling.innerHTML = "";

        event.preventDefault(); //不要讓表單以傳統的方式(跳轉頁面)送出

        let isPass = true; //TODO:   檢查資料格式 前置 2.有沒有通過檢查 預設為true

        //email 如果有填才檢查 沒填不檢查
        if (emailEl.value && !validateEmail(emailEl.value)) {
            isPass = false;
            emailEl.style.border = "2px solid red";
            emailEl.nextElementSibling.innerHTML = "請輸入正確的Email";
        }


        //如果有通過檢查才發送給後端
        if (isPass) {

            const fd = new FormData(document.form1); //將有外觀的表單(使用者輸入的地方)的資料複製到沒有外觀的表單再傳送給後端
            //陣列迭代
            //     for(let i of fd.entries()){
            //     console.log(i);
            // }
            fetch('login-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(result => {
                    console.log(result);
                    if (result.success) {
                        location.href="index_.php" ;
                    } else {
                        failModal.show();
                    }
                })
                .catch(ex => {
                    console.log(ex);
                })
        }


    }

    const failModal = new bootstrap.Modal('#failModal');
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>