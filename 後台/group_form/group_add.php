<?php
require '../parts/form_pdo-connect.php';
session_start();
$title = "團體表單";
$pageName = 'groupForm';

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
              <h5 class="card-title text-center">新增團體表單</h5>

              <form name="form1" onsubmit="sendData(event)">

                <div class="mb-2 ">
                  <label for="group_id" class="form-label">團體行程 I D</label>
                  <input type="text" class="form-control" id="group_id" name="group_id">
                  <div class="form-text"></div>
                </div>
                <div class="mb-2 ">
                  <label for="name" class="form-label">姓名</label>
                  <input type="text" class="form-control" id="name" name="name">
                  <div class="form-text"></div>
                </div>
                <div class="mb-2 ">
                  <label for="text" class="form-label">身分證字號</label>
                  <input type="text" class="form-control" id="nameid" name="nameid">
                  <div class="form-text"></div>
                </div>
                <div class="mb-2 ">
                  <label for="birthday" class="form-label">西元生日</label>
                  <input type="date" class="form-control" id="birthday" name="birthday">
                  <div class="form-text"></div>
                </div>
                <div class="mb-2 ">
                  <label for="email" class="form-label">信箱</label>
                  <input type="email" class="form-control" id="email" name="email">
                  <div class="form-text"></div>
                </div>
                <div class="mb-2 ">
                  <label for="mobile" class="form-label">手機號碼</label>
                  <input type="text" class="form-control" id="mobile" name="mobile">
                  <div class="form-text"></div>
                </div>
                <div class="mb-2 ">
                  <label for="address" class="form-label">地址</label>
                  <input type="text" class="form-control" id="address" name="address">
                  <div class="form-text"></div>
                </div>
                <button type="submit" class="btn btn-primary">送出</button>
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
<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
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

    // 判斷有無通過檢查，預true，紅框+套入正規化
    let isPass = true;
    //groupid必填，檢查格式，空白錯誤
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
      fetch('group_add_api.php', {
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