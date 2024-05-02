<?php
require '../parts/pdo_connect.php';
session_start();

$title = "員工管理";
$pageName = 'employees';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$isAbled = $_SESSION['permission']['employees'] == 'view' ? 'disabled' : '';
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

?>

<?php include '../parts/html-head.php' ?>
<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>
<?php
# 抓 employees 的资料
// $employees_sql = "SELECT * FROM employees";
// $employees_result = $conn->query($employees_sql);
# 抓 employees 的资料
$employees_sql =
  sprintf(
    "SELECT *
    FROM employees
    INNER JOIN department 
    ON employees.department_id = department.department_id
    INNER JOIN title 
    ON employees.title_id = title.title_id
    INNER JOIN employees_info 
    ON employees.employee_id = employees_info.employee_id
    ORDER BY employees.employee_id ASC 
    ",
  );
$employees_result = $conn->query($employees_sql);

?>
<div class="container-fluid pt-4 px-4" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
    <div class="bg-secondary rounded h-100 p-4 ">
      <h3 class="pb-3">員工管理</h3>
      <!-- add form start -->
      <button type="button" class="btn btn-outline-info mb-3 " data-bs-toggle="modal" data-bs-target="#addBackdrop" <?= $isAbled ?>>新增</button>
      <div class="modal fade " id="addBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-secondary border-0">
            <form action="employees-add.php" method="post">
              <div class="modal-header">
                <h5 class="modal-title" id="addLabel">新增員工</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <?php
              $types = ["text", "text", "phone", "email", "date", "date", "date"];
              $labels = ["姓名", "身份証字號", "行動電話", "信箱", "生日", "入職日期", "離職日期"];
              $names = ["employee_name", "national_id", "mobile", "email", "birthday", "hireDate", "leaveDate"];
              $ids = ["employee_name", "national_id", "mobile", "email", "birthday", "hireDate", "leaveDate"];
              $placeholders = ["新建名稱", "首字母請大寫", "09", " example@gmail.com", "", "", ""];
              $isRequired = ["required", "required", "required", "required", "required", "required", ""];

              ?>

              <div class="modal-body ">
                <div class="permissionBox d-flex justify-content-center">
                  <div class="permissionBoxLeft">
                    <?php
                    $num = count($labels);
                    for ($i = 0; $i < ($num + 1) / 2; $i++) : ?>
                      <div class="permissionItem m-3 ">
                        <label for=<?= $names[$i] ?>>
                          <h6><?= $labels[$i] ?></h6>
                        </label>
                        <input type="<?= $types[$i] ?>" class="form-control" placeholder=<?= $placeholders[$i] ?> aria-label=<?= $names[$i] ?> aria-describedby="basic-addon1" name="<?= $names[$i] ?>" id="<?= $ids[$i] ?>" <?= $isRequired[$i] ?>>
                      </div>
                    <?php endfor; ?>
                  </div>
                  <div class="permissionBoxMiddle">
                    <?php
                    for ($i = ($num + 1) / 2; $i < $num; $i++) : ?>
                      <div class="permissionItem m-3 ">
                        <label for=<?= $names[$i] ?>>
                          <h6><?= $labels[$i] ?></h6>
                        </label>
                        <input type="<?= $types[$i] ?>" class="form-control" placeholder=<?= $placeholders[$i] ?> aria-label=<?= $names[$i] ?> aria-describedby="basic-addon1" name="<?= $names[$i] ?>" id="<?= $ids[$i] ?>" <?= $isRequired[$i] ?>>
                      </div>
                    <?php endfor; ?>
                    <!-- 狀態欄位 Start -->
                    <div class="permissionItem m-3 ">

                      <h6>帳號狀態</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">

                        <div class="btn-group" role="group">
                          <input name="itinerary[]" type="checkbox" class="btn-check" id="viewItinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary[]')" checked="true" value="view">
                          <label class="btn btn-outline-info" for="viewItinerary">啟用</label>

                          <input name="itinerary[]" type="checkbox" class="btn-check" id="editItinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary[]')" value="edit">
                          <label class="btn btn-outline-info" for="editItinerary">禁用</label>
                        </div>
                      </div>

                    </div>
                    <!-- 狀態欄位 End -->
                  </div>
                  <div class="permissionBoxRight">
                    <div class="permissionItem m-3">
                      <label for="county">
                        <h6>縣市：</h6>
                      </label>
                      <select id="county" name="county" onchange="updateTownship() " class="form-control" required>
                        <option value="">請選擇</option>

                        <?php include './phpPart/countryOption.php' ?>
                      </select>
                    </div>

                    <div class="permissionItem m-3">

                      <!-- 鄉鎮市區選擇 -->
                      <label for="township">
                        <h6>鄉鎮市區：</h6>
                      </label>
                      <select id="township" name="township" class="form-control" required>
                        <option value="">請先選擇縣市</option>
                      </select>
                    </div>

                    <!-- 詳細地址輸入 -->
                    <div class="permissionItem m-3 h-100">
                      <label for="address">
                        <h6>詳細地址：</h6>
                      </label>
                      <textarea class="form-control p-2" id="address" name="address" required style="min-height: 35%"></textarea>
                    </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-info">新增</button>
              </div>
            </form>

          </div>
        </div>
      </div>
      <!-- add form end -->



      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center">員工編號</th>
            <th class="text-center">姓名</th>
            <!-- <th class="text-center">密碼</th> -->
            <!-- <th class="text-center">email</th> -->
            <!-- <th class="text-center">聯絡電話</th> -->
            <th class="text-center">部門</th>
            <th class="text-center">職稱</th>
            <th class="text-center">員工資訊</th>
            <!-- <th class="text-center">角色身份</th> -->
            <!-- <th class="text-center">昵稱</th> -->
            <th class="text-center">帳號狀態</th>
            <!-- <th class="text-center">創建時間</th> -->
            <th class="text-center">編輯</th>
            <th class="text-center">刪除</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($employees_result as $r) : ?>
            <tr>

              <td class="text-center"><?= $r['employee_id'] ?></td>
              <td class="text-center"><?= $r['employee_name'] ?></td>
              <!-- <td class="text-center"><?= $r['email'] ?></td> -->
              <td class="text-center"><?= $r['department_ch'] ?></td>
              <td class="text-center"><?= $r['title_ch'] ?></td>
              <td class="text-center">


                <button class="btn btn-outline-warning " type="button" data-bs-toggle="collapse" data-bs-target="#employeeInfo<?= $r['employee_id'] ?>" aria-expanded="false" aria-controls="employeeInfo<?= $r['employee_id'] ?>">
                  詳細資訊
                </button>
              </td>
              <td class="text-center"><?= $r['status'] == 1 ? "啟用" : "禁用" ?></td>
              <td class="text-center"><a href="" class="<?= $isAbled ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
              <td class="text-center">
                <a href="javascript: deleteOne(<?= $r['employee_id'] ?>)" class="vstack <?= $isAbled ?>">
                  <i class="fa-solid fa-trash text-danger"></i>
                </a>
              </td>
            </tr>
            <tr class="collapse" id="employeeInfo<?= $r['employee_id'] ?>">
              <td colspan="8">

                <div class="employeeInfo<?= $r['employee_id'] ?>">
                  <div class="employeeInfoBox d-flex w-100">

                    <div class="employeeInfoLeft m-3 w-50">
                      <ul>
                        <li>身分證字號：<?= $r['id_card_number'] ?></li>
                        <li>生日：<?= $r['birthday'] ?></li>
                        <li>部門：<?= $r['department_ch'] ?> <?= $r['department_en'] ?></li>
                        <li>職稱：<?= $r['title_ch'] ?> <?= $r['title_en'] ?></li>
                        <li>信箱：<a href="mailto:<?= $r['email'] ?>"><?= $r['email'] ?></a></li>
                      </ul>
                    </div>
                    <div class="employeeInfoRight m-3 w-50">
                      <ul>
                        <li>電話：<?= $r['mobile'] ?></li>
                        <li>地址：<?= $r['employee_address'] ?></li>
                        <li>入職時間：<?= $r['hire_date'] ?></li>
                        <li>離職時間：<?= $r['leave_date'] ? $r['leave_date'] : "-" ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

          <?php endforeach ?>
        </tbody>

      </table>


      <!-- 頁碼區塊 -->
      <?php include '../parts/pagination.php' ?>
    </div>
  </div>
</div>





<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>

<script src="./js/address.js"></script>

<script src="./js/nowDate.js"></script>
<script src="./js/employeesinfo.js"></script>



<?php include '../parts/html-foot.php' ?>