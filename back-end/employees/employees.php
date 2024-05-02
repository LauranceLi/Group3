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
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;   #轉換成整數
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

# 每一頁有幾筆
$per_page = 10;

# 計算總筆數
$pages_sql = "SELECT COUNT(1) FROM role_set";
$pages_result = $conn->query($pages_sql)->fetch_assoc();
$total_rows = $pages_result['COUNT(1)'];


$total_pages = ceil($total_rows / $per_page); # 總頁數
$per_page_row = [];
if ($total_rows > 0) {
  if ($page > $total_pages) {
    header('Location: ?page=' . $total_pages);
    exit;
  }
}

# 抓 employees 的资料
$employees_sql = "SELECT * FROM employees";
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
            <form action="roleList-add.php" method="post">
              <div class="modal-header">
                <h5 class="modal-title" id="addLabel">新增員工</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <?php
              $types=["text", "text", "phone","email","date"];
              $labels = ["姓名", "身份証字號", "行動電話","信箱","生日"];
              $names = ["employee_name", "national_id", "mobile", "email","birthday"];
              $placeholders = ["新建名稱", "首字母請大寫", "09", " example@gmail.com",""]

              ?>

              <div class="modal-body ">
                <div class="permissionBox d-flex justify-content-between">
                  <div class="permissionBoxLeft">

                    <?php
                    for ($i = 0; $i < count($labels); $i++) : ?>
                      <div class="permissionItem m-3 ">
                        <label for=<?= $names[$i] ?>>
                          <h6><?= $labels[$i] ?></h6>
                        </label>
                        <input 
                        type="<?= $types[$i] ?>" 
                        class="form-control" 
                        placeholder=<?= $placeholders[$i] ?> aria-label=<?= $names[$i] ?> aria-describedby="basic-addon1" 
                        name="<?= $names[$i] ?>"
                        required>
                      </div>
                    <?php endfor; ?>
                  </div>
                  <div class="permissionBoxRight">
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

                  </div>
                  <div class="form-floating m-3">
                    <h6>相關描述</h6>
                    <textarea class="form-control p-2" name="new_role_desc" id="new_role_desc" style="min-height: 91%"></textarea>
                    <label for="new_role_desc"></label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
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
            <th class="text-center">email</th>
            <!-- <th class="text-center">聯絡電話</th> -->
            <th class="text-center">部門</th>
            <th class="text-center">職稱</th>
            <th class="text-center">詳情</th>
            <!-- <th class="text-center">角色身份</th> -->
            <!-- <th class="text-center">昵稱</th> -->
            <th class="text-center">狀態</th>
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
              <td class="text-center"><?= $r['email'] ?></td>
              <td class="text-center"><?= $r['department_id'] ?></td>
              <td class="text-center"><?= $r['title_id'] ?></td>
              <td class="text-center">详情按钮</td>

              <td class="text-center"><?= $r['status'] == 1 ? "啟用" : "禁用" ?></td>
              <td class="text-center"><a href="" class="<?= $isAbled ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
              <td class="text-center">
                <a href="javascript: deleteOne(<?= $r['employee_id'] ?>)" class="vstack <?= $isAbled ?>">
                  <i class="fa-solid fa-trash text-danger"></i>
                </a>
              </td>


            </tr>

          <?php endforeach ?>
        </tbody>

      </table>


      <!-- 頁碼區塊 -->
      <nav aria-label="First group">
        <ul class="pagination justify-content-center ">
          <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
            <a class="page-link bg-secondary border-light" href="?page=<?= 1 ?>">
              <i class="fa-solid fa-angles-left"></i>
            </a>
          </li>
          <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
            <a class="page-link bg-secondary border-light" href="?page=<?= $page - 1 ?>">
              <i class="fa-solid fa-angle-left"></i>
            </a>
          </li>
          <!-- 限制頁碼條 -->
          <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
            <?php if ($i >= 1 and $i <= $total_pages) : ?>
              <li class="page-item <?= $i != $page ?: 'active' ?>">
                <a class="page-link <?= $i != $page ? 'bg-secondary border-light' : 'active' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endif ?>
          <?php endfor ?>
          <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
            <a class="page-link bg-secondary border-light" href="?page=<?= $page + 1 ?>">
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </li>
          <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
            <a class="page-link bg-secondary border-light" href="?page=<?= $total_pages ?>">
              <i class="fa-solid fa-angles-right"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>





<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<?php include '../parts/html-foot.php' ?>