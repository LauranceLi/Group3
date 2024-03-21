<?php include __DIR__ . '/../part/html-head.php'; 
include __DIR__ . '/serve_navbar.php';  #主要欄位
require __DIR__ . '/serve_pdo-connect.php';  #附上資料庫連結


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;   #轉換成整數
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$perPage = 5;      #每頁幾項

$t_sql = "SELECT COUNT(1) FROM serve_list";     #搜尋筆數
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; #總筆數
$totalPages = ceil($totalRows / $perPage);       #總頁數   
$rows = []; #預設為空陣列

if ($page > $totalPages) {                      #如當前頁數>總頁數
    header('Location: ?page=' . $totalPages);   #就會跳到最前或最後，然後結束
    exit;
}

$sql = sprintf("SELECT * FROM serve_list LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll();
?>

<!-- 轉換成json文字，陣列呈現---註解中 -->
<!-- <div><?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?></div> -->

<!-- 把PHP的JSON轉換成JS的字串 。轉換資料，不是溝通。前後端分開不太適用-->
<script>
    const myRows = <?= $totalRows ?>;
</script>

<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>


<!-- 點列表LIST出現的部分 -->
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <!-- <span>總頁數<?= $totalPages ?></span> -->
<!-- 頁碼區塊 -->
        <span>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a>
                    </li>

                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-chevron-left"></i></a></li>

                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) : ?>
                        <?php if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    
                    <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    </li>
                        <?php endif ?>
                    <?php endfor ?>
                    
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-chevron-right"></i></a></li>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a></li>

                </ul>
            </nav>
        </span>
<!-- 下方欄位區塊 -->
        <table class="table table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">修改</th>
                    <th class="text-center">編號</th>
                    <th class="text-center">團體行程 I D</th>
                    <th class="text-center">姓名</th>
                    <th class="text-center">手機</th>
                    <th class="text-center">信箱</th>
                    <th class="text-center">餐廳</th>
                    <th class="text-center">餐廳地址</th>
                    <th class="text-center">餐廳預約時間</th>
                    <th class="text-center">航空公司</th>
                    <th class="text-center">機場名</th>
                    <th class="text-center">搭機時間</th>
                    <th class="text-center">飯店名稱</th>
                    <th class="text-center">飯店地址</th>
                    <th class="text-center">刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td class="text-center"><a href="serve_edit.php?sid=<?= $r['sid'] ?>"><i class="fa-regular fa-pen-to-square"></i></a></td>
<td class="text-center"><?= $r['sid'] ?></td>
                        <td class="text-center"><?= $r['group_id'] ?></td>
                        <td class="text-center"><?= $r['name'] ?></td>
                        <td class="text-center"><?= $r['mobile'] ?></td>
                        <td class="text-center"><?= $r['email'] ?></td>
                        <td class="text-center"><?= $r['restaurant'] ?></td>
                        <td class="text-center"><?= $r['restaurantaddress'] ?></td>
                        <td class="text-center"><?= $r['restauranttime'] ?></td>
                        <td class="text-center"><?= $r['airline'] ?></td>
                        <td class="text-center"><?= $r['airportplace'] ?></td>
                        <td class="text-center"><?= $r['airporttime'] ?></td>
                        <td class="text-center"><?= $r['hotelname'] ?></td>
                        <td class="text-center"><?= $r['hoteladdress'] ?></td>
                        <td class="text-center"><a href="serve_delite.php?sid=<?= $r['sid'] ?>"><i class="fa-regular fa-trash-can"></i></a></td>
                    </tr>

                <?php endforeach ?>
            </tbody>
        </table>
</div>

    <!-- 新增區 -->
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">新增服務預約資料</h5>

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
                                    <label for="mobile" class="form-label">手機</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="email" class="form-label">信箱</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="restaurant" class="form-label">餐廳</label>
                                    <input type="text" class="form-control" id="restaurant" name="restaurant">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="restaurantaddress" class="form-label">餐廳地址</label>
                                    <input type="text" class="form-control" id="restaurantaddress" name="restaurantaddress">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                    <label for="restauranttime" class="form-label">餐廳預約時間</label>
                                    <input type="datetime-local" class="form-control" id="restauranttime" name="restauranttime">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                <label for="airline" class="form-label">航空公司</label>
                                    <input type="text" class="form-control" id="airline" name="airline">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                <label for="airportplace" class="form-label">機場名</label>
                                    <input type="text" class="form-control" id="airportplace" name="airportplace">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                <label for="airporttime" class="form-label">搭機時間</label>
                                    <input type="datetime-local" class="form-control" id="airporttime" name="airporttime">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                <label for="hotelname" class="form-label">飯店名稱</label>
                                    <input type="text" class="form-control" id="hotelname" name="hotelname">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-2 ">
                                <label for="hoteladdress" class="form-label">飯店地址</label>
                                    <input type="text" class="form-control" id="hoteladdress" name="hoteladdress">
                                    <div class="form-text"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">送出</button>
                            </form>
                        </div>
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

<script>
    const {
        group_id: groupidField,
        name: nameField,
        mobile: mobileField,
        email: emailField,
        restaurant: restaurantField,
        restaurantaddress: restaurantaddressField,
        restauranttime: restauranttimeField,
        airline: airlineField,
        airportplace: airportplaceField,
        airporttime: airporttimeField,
        hotelname: hotelnameField,
        hoteladdress: hoteladdressField
    } = document.form1;


    function sendData(e) {

        // 欄位的外觀要回復原來的狀態
        groupidField.style.border = "1px solid #CCC";
        groupidField.nextElementSibling.innerHTML = '';
        nameField.style.border = "1px solid #CCC";
        nameField.nextElementSibling.innerHTML = '';
        mobileField.style.border = "1px solid #CCC";
        mobileField.nextElementSibling.innerHTML = '';
        emailField.style.border = "1px solid #CCC";
        emailField.nextElementSibling.innerHTML = '';
        restaurantField.style.border = "1px solid #CCC";
        restaurantField.nextElementSibling.innerHTML = '';
        restaurantaddressField.style.border = "1px solid #CCC";
        restaurantaddressField.nextElementSibling.innerHTML = '';
        restauranttimeField.style.border = "1px solid #CCC";
        restauranttimeField.nextElementSibling.innerHTML = '';
        airlineField.style.border = "1px solid #CCC";
        airlineField.nextElementSibling.innerHTML = '';
        airportplaceField.style.border = "1px solid #CCC";
        airportplaceField.nextElementSibling.innerHTML = '';
        airporttimeField.style.border = "1px solid #CCC";
        airporttimeField.nextElementSibling.innerHTML = '';
        hotelnameField.style.border = "1px solid #CCC";
        hotelnameField.nextElementSibling.innerHTML = '';
        hoteladdressField.style.border = "1px solid #CCC";
        hoteladdressField.nextElementSibling.innerHTML = '';

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
        //name必填，檢查格式，空白錯誤
        if (nameField.value === '' ) {
            isPass = false;
            nameField.style.border = "2px solid red";
            nameField.nextElementSibling.innerHTML = '請輸入姓名';
        }
        // mobile 必填，檢查格式，空白錯誤
        if (mobileField.value.lenght < 9 || !validateMobile(mobileField.value) || mobileField.value === '' || !/^\d+$/.test(mobileField.value)) {
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
        //restaurant必填，檢查格式，空白錯誤
        if (restaurantField.value === '' ) {
            isPass = false;
            restaurantField.style.border = "2px solid red";
            restaurantField.nextElementSibling.innerHTML = '請輸入餐廳店名';
        }
        //restaurantaddress必填，檢查格式，空白錯誤
        if (restaurantaddressField.value === '' ) {
            isPass = false;
            restaurantaddressField.style.border = "2px solid red";
            restaurantaddressField.nextElementSibling.innerHTML = '請輸入餐廳地點';
        }
        //restauranttime必填，檢查格式，空白錯誤
        if (restauranttimeField.value === '' ) {
            isPass = false;
            restauranttimeField.style.border = "2px solid red";
            restauranttimeField.nextElementSibling.innerHTML = '請輸入餐廳預約時間';
        }
        //airline必填，檢查格式，空白錯誤
        if (airlineField.value === '' ) {
            isPass = false;
            airlineField.style.border = "2px solid red";
            airlineField.nextElementSibling.innerHTML = '請輸入航空公司名稱';
        }
        //airportplace必填，檢查格式，空白錯誤
        if (airportplaceField.value === '' ) {
            isPass = false;
            airportplaceField.style.border = "2px solid red";
            airportplaceField.nextElementSibling.innerHTML = '請輸入機場名稱';
        }
        //airporttime必填，檢查格式，空白錯誤
        if (airporttimeField.value === '' ) {
            isPass = false;
            airporttimeField.style.border = "2px solid red";
            airporttimeField.nextElementSibling.innerHTML = '請輸入搭機時間';
        }
        //hotelname必填，檢查格式，空白錯誤
        if (hotelnameField.value === '' ) {
            isPass = false;
            hotelnameField.style.border = "2px solid red";
            hotelnameField.nextElementSibling.innerHTML = '請輸入住宿飯店名稱';
        }
        //hoteladdress必填，檢查格式，空白錯誤
        if (hoteladdressField.value === '' ) {
            isPass = false;
            hoteladdressField.style.border = "2px solid red";
            hoteladdressField.nextElementSibling.innerHTML = '請輸入住宿飯店地址';
        }

        // 正規化區塊
        //group_id 檢查格式
        function validategroup_id(group_id) {
            const groupid =
                /^(0|[1-9]|[1-9][0-9]?)$/;
            return groupid.test(group_id);
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
            fetch('serve_add_api.php', {
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