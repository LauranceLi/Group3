<?php
require __DIR__ . '/parts/pdo_connect.php';
session_start();
$title = "Role List";
$pageName = 'roleList';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
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



$permission_sql =
  sprintf(
    "SELECT *
  FROM permission
  INNER JOIN role_set
  ON role_set.role_id = permission.permission_role_id
  ORDER BY role_id ASC LIMIT %s, %s",
    ($page - 1) * $per_page,
    $per_page
  );

$permission_result = $conn->query($permission_sql);

function permission_icon($permission_r)
{
  if ($permission_r == 'edit') {
    echo '<i class="fa-solid fa-pen-to-square"></i>';
  } else if ($permission_r == 'view') {
    echo '<i class="fa-solid fa-eye"></i>';
  } else {
    echo '<i class="fa-solid fa-square-xmark"></i>';
  }
};


function isView($item)
{
  if ($item == 'view' || $item == 'edit') {
    echo 'checked="true"';
  } else{
    echo '';
  }
}
function isEdit($item)
{
  if ($item == 'edit') {
    echo 'checked="true"';
  } else{
    echo '';
  }
}

?>


<?php include __DIR__ . '/parts/html-head.php' ?>
<style>
  table {
    table-layout: fixed;
  }
</style>

<?php include __DIR__ . '/parts/spinner.php' ?>
<?php include __DIR__ . '/parts/slidebar.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-12 col-xl-12">
      <div class="bg-secondary rounded h-100 p-4">
        <div class="roleListTitleBox d-flex justify-content-between">
          <h3 class="mb-3">角色權限一覽</h3>
          <!-- add form start -->
          <button type="button" class="btn btn-outline-info mb-3 " data-bs-toggle="modal" data-bs-target="#addBackdrop">新增</button>
          <div class="modal fade " id="addBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content bg-secondary border-0">
                <form action="roleList-add.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addLabel">新增角色</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body ">
                    <h6>角色名稱</h6>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="新建名稱" aria-label="Username" aria-describedby="basic-addon1" name="new_role_name">
                    </div>

                    <div class="permissionBox d-flex justify-content-between">
                      <div class="permissionBoxLeft">
                        <div class="permissionItem m-3 ">
                          <h6>角色設置</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="1" type="checkbox" role="switch" id="roleSetCheckAll" onclick="checkAll(this,'roleSet[]')">
                              <label class="form-check-label " for="roleSetCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="roleSet[]" type="checkbox" class="btn-check" id="viewRoleSet" autocomplete="off" checked="true" onclick="allCheck('roleSetCheckAll','roleSet[]') " value="view">
                              <label class="btn btn-outline-info" for="viewRoleSet">檢視</label>

                              <input name="roleSet[]" type="checkbox" class="btn-check" id="editRoleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet[]')" value="edit">
                              <label class="btn btn-outline-info" for="editRoleSet">編輯</label>


                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>員工管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="view" type="checkbox" role="switch" id="employeesCheckAll" onclick="checkAll(this,'employee[]')">
                              <label class="form-check-label " for="employeesCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="employee[]" type="checkbox" class="btn-check" id="viewEmployee" autocomplete="off" onclick="allCheck('employeesCheckAll','employee[]')" checked="true" value="view">
                              <label class="btn btn-outline-info" for="viewEmployee">檢視</label>

                              <input name="employee[]" type="checkbox" class="btn-check" id="editEmployee" autocomplete="off" onclick="allCheck('employeesCheckAll','employee[]')" value="edit">
                              <label class="btn btn-outline-info" for="editEmployee">編輯</label>

                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>會員管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="3" type="checkbox" role="switch" id="membersCheckAll" onclick="checkAll(this,'member[]')">
                              <label class="form-check-label " for="membersCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="member[]" type="checkbox" class="btn-check" id="viewMember" autocomplete="off" onclick="allCheck('membersCheckAll','member[]')" checked="true" value="view">
                              <label class="btn btn-outline-info" for="viewMember">檢視</label>

                              <input name="member[]" type="checkbox" class="btn-check" id="editMember" autocomplete="off" onclick="allCheck('membersCheckAll','member[]')" value="edit">
                              <label class="btn btn-outline-info" for="editMember">編輯</label>

                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>積分管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="4" type="checkbox" role="switch" id="pointsCheckAll" onclick="checkAll(this,'point[]')">
                              <label class="form-check-label " for="pointsCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="point[]" type="checkbox" class="btn-check" id="viewPoint" autocomplete="off" onclick="allCheck('pointsCheckAll','point[]')" checked="true" value="view">
                              <label class="btn btn-outline-info" for="viewPoint">檢視</label>

                              <input name="point[]" type="checkbox" class="btn-check" id="editPoint" autocomplete="off" onclick="allCheck('pointsCheckAll','point[]')" value="edit">
                              <label class="btn btn-outline-info" for="editPoint">編輯</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="permissionBoxRight">
                        <div class="permissionItem m-3 ">

                          <h6>套裝行程管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="5" type="checkbox" role="switch" id="itineraryCheckAll" onclick="checkAll(this,'itinerary[]')">
                              <label class="form-check-label " for="itineraryCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="itinerary[]" type="checkbox" class="btn-check" id="viewItinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary[]')" checked="true" value="view">
                              <label class="btn btn-outline-info" for="viewItinerary">檢視</label>

                              <input name="itinerary[]" type="checkbox" class="btn-check" id="editItinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary[]')" value="edit">
                              <label class="btn btn-outline-info" for="editItinerary">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>訂單管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="6" type="checkbox" role="switch" id="ordersCheckAll" onclick="checkAll(this,'order[]')">
                              <label class="form-check-label " for="ordersCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="order[]" type="checkbox" class="btn-check" id="viewOrder" autocomplete="off" onclick="allCheck('ordersCheckAll','order[]')" checked="true" value="view">
                              <label class="btn btn-outline-info" for="viewOrder">檢視</label>

                              <input name="order[]" type="checkbox" class="btn-check" id="editOrder" autocomplete="off" onclick="allCheck('ordersCheckAll','order[]')" value="edit">
                              <label class="btn btn-outline-info" for="editOrder">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>商品上架管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="7" type="checkbox" role="switch" id="productsCheckAll" onclick="checkAll(this,'product[]')">
                              <label class="form-check-label " for="productsCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="product[]" type="checkbox" class="btn-check" id="viewProduct" autocomplete="off" checked="true" onclick="allCheck('productsCheckAll','product[]')">
                              <label class="btn btn-outline-info" for="viewProduct" value="view">檢視</label>

                              <input name="product[]" type="checkbox" class="btn-check" id="editProduct" autocomplete="off" onclick="allCheck('productsCheckAll','product[]')" value="edit">
                              <label class="btn btn-outline-info" for="editProduct">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>表單管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="8" type="checkbox" role="switch" id="formCheckAll" onclick="checkAll(this,'form[]')">
                              <label class="form-check-label " for="formCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="form[]" type="checkbox" class="btn-check" id="viewForm" autocomplete="off" onclick="allCheck('formCheckAll','form[]')" checked="true">
                              <label class="btn btn-outline-info" for="viewForm">檢視</label>

                              <input name="form[]" type="checkbox" class="btn-check" id="editForm" autocomplete="off" onclick="allCheck('formCheckAll','form[]')" value="edit">
                              <label class="btn btn-outline-info" for="editForm">編輯</label>

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
        </div>

        <div class="descript">
          <p>說明：<i class="fa-solid fa-pen-to-square me-1"></i>可供編輯、<i class="fa-solid fa-eye me-1"></i>僅供檢視、<i class="fa-solid fa-square-xmark me-1"></i>無任何權限</p>
        </div>
        <!-- Role List Start -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" class="text-center">角色名稱</th>
              <th scope="col" class="text-center">角色權限管理</th>
              <th scope="col" class="text-center">員工管理</th>
              <th scope="col" class="text-center">會員管理</th>
              <th scope="col" class="text-center">積分管理</th>
              <th scope="col" class="text-center">套裝行程管理</th>
              <th scope="col" class="text-center">訂單管理</th>
              <th scope="col" class="text-center">商品上架管理</th>
              <th scope="col" class="text-center">表單管理</th>
              <th scope="col" class="text-center">編輯
              </th>
              <th scope="col" class="text-center">刪除</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($permission_result as $r) : ?>
              <tr>
                <td class="text-center"><?= $r['role_name'] ?></td>
                <td class="text-center">
                  <?php permission_icon($r['role_set']); ?>
                </td>
                <td class="text-center">
                  <?php permission_icon($r['employees']); ?>
                </td>
                <td class="text-center">
                  <?php permission_icon($r['members']); ?>
                </td>
                <td class="text-center">
                  <?php permission_icon($r['points']); ?>
                </td>
                <td class="text-center">
                  <?php permission_icon($r['itinerary']); ?>
                </td>
                <td class="text-center">
                  <?php permission_icon($r['orders']); ?>
                </td>
                <td class="text-center">
                  <?php permission_icon($r['products']); ?>
                </td>
                <td class="text-center">
                  <?php permission_icon($r['form']); ?>
                </td>
                <td class="text-center">
                  <a href="#" class="vstack" data-bs-toggle="modal" data-bs-target="#editBackdrop<?= $r['role_id'] ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </td>
                <!-- edit form start -->
                <?php
                $role_id = $r['role_id'];
                $edit_sql = "SELECT *
                            FROM permission
                            INNER JOIN role_set
                            ON role_set.role_id = permission.permission_role_id
                            WHERE role_id = $role_id ";
                $edit_sql_result = $conn->query($edit_sql)->fetch_assoc();
                $edit_name = $edit_sql_result['role_name'];
                ?>
                <div class="modal fade " id="editBackdrop<?= $r['role_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-secondary border-0">
                      <form action="roleList.php" method="post">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editLabel">編輯角色</h5>
                        </div>
                        <div class="modal-body ">
                          <h6>角色名稱</h6>
                          <div class="input-group mb-3">

                            <input type="text" class="form-control" name="new_role_name" value="<?= $edit_sql_result['role_name'] ?>" readonly>
                          </div>

                          <div class="permissionBox d-flex justify-content-between">
                            <div class="permissionBoxLeft">
                              <div class="permissionItem m-3 ">
                                <h6>角色設置</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="1" type="checkbox" role="switch" id="<?= $r['role_id'] ?>roleSetCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>roleSet')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>roleSetCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>roleSet" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewRoleSet" autocomplete="off" <?php isView($r['role_set']) ?> onclick="allCheck('<?= $r['role_id'] ?>roleSetCheckAll','<?= $r['role_id'] ?>roleSet') ">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewRoleSet">檢視</label>

                                    <input name="<?= $r['role_id'] ?>roleSet" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editRoleSet" autocomplete="off" <?php isEdit($r['role_set']) ?> onclick="allCheck('<?= $r['role_id'] ?>roleSetCheckAll','<?= $r['role_id'] ?>roleSet')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editRoleSet">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>員工管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="2" type="checkbox" role="switch" id="<?= $r['role_id'] ?>employeesCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>employee')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>employeesCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>employee" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewEmployee" autocomplete="off"  <?php isView($r['employees']) ?> onclick="allCheck('<?= $r['role_id'] ?>employeesCheckAll','<?= $r['role_id'] ?>employee')" >
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewEmployee">檢視</label>

                                    <input name="<?= $r['role_id'] ?>employee" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editEmployee" autocomplete="off"  <?php isEdit($r['employees']) ?> onclick="allCheck('<?= $r['role_id'] ?>employeesCheckAll','<?= $r['role_id'] ?>employee')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editEmployee">編輯</label>

                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>會員管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="3" type="checkbox" role="switch" id="<?= $r['role_id'] ?>membersCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>member')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>membersCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>member" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewMember" autocomplete="off"  <?php isView($r['members']) ?> onclick="allCheck('<?= $r['role_id'] ?>membersCheckAll','<?= $r['role_id'] ?>member')" >
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewMember">檢視</label>

                                    <input name="<?= $r['role_id'] ?>member" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editMember" autocomplete="off"  <?php isEdit($r['members']) ?> onclick="allCheck('<?= $r['role_id'] ?>membersCheckAll','<?= $r['role_id'] ?>member')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editMember">編輯</label>

                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>積分管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="4" type="checkbox" role="switch" id="<?= $r['role_id'] ?>pointsCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>point')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>pointsCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>point" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewPoint" autocomplete="off"  <?php isView($r['points']) ?> onclick="allCheck('<?= $r['role_id'] ?>pointsCheckAll','<?= $r['role_id'] ?>point')" >
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewPoint">檢視</label>

                                    <input name="<?= $r['role_id'] ?>point" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editPoint" autocomplete="off"  <?php isEdit($r['points']) ?> onclick="allCheck('<?= $r['role_id'] ?>pointsCheckAll','<?= $r['role_id'] ?>point')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editPoint">編輯</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="permissionBoxRight">
                              <div class="permissionItem m-3 ">

                                <h6>套裝行程管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="5" type="checkbox" role="switch" id="<?= $r['role_id'] ?>itineraryCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>itinerary')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>itineraryCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>itinerary" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewItinerary" autocomplete="off"  <?php isView($r['itinerary']) ?> onclick="allCheck('<?= $r['role_id'] ?>itineraryCheckAll','<?= $r['role_id'] ?>itinerary')" >
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewItinerary">檢視</label>

                                    <input name="<?= $r['role_id'] ?>itinerary" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editItinerary" autocomplete="off"  <?php isEdit($r['itinerary']) ?> onclick="allCheck('<?= $r['role_id'] ?>itineraryCheckAll','<?= $r['role_id'] ?>itinerary')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editItinerary">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>訂單管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="6" type="checkbox" role="switch" id="<?= $r['role_id'] ?>ordersCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>order')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>ordersCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>order" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewOrder" autocomplete="off"  <?php isView($r['orders']) ?> onclick="allCheck('<?= $r['role_id'] ?>ordersCheckAll','<?= $r['role_id'] ?>order')" >
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewOrder">檢視</label>

                                    <input name="<?= $r['role_id'] ?>order" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editOrder" autocomplete="off"  <?php isEdit($r['orders']) ?> onclick="allCheck('<?= $r['role_id'] ?>ordersCheckAll','<?= $r['role_id'] ?>order')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editOrder">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>商品上架管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="7" type="checkbox" role="switch" id="<?= $r['role_id'] ?>productsCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>product')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>productsCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>product" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewProduct" autocomplete="off"   <?php isView($r['products']) ?> onclick="allCheck('<?= $r['role_id'] ?>productsCheckAll','<?= $r['role_id'] ?>product')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewProduct">檢視</label>

                                    <input name="<?= $r['role_id'] ?>product" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editProduct" autocomplete="off"  <?php isEdit($r['products']) ?> onclick="allCheck('<?= $r['role_id'] ?>productsCheckAll','<?= $r['role_id'] ?>product')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editProduct">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>表單管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="8" type="checkbox" role="switch" id="<?= $r['role_id'] ?>formCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>form')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>formCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>form" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewForm" autocomplete="off"  <?php isView($r['form']) ?> onclick="allCheck('<?= $r['role_id'] ?>formCheckAll','<?= $r['role_id'] ?>form')" >
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewForm">檢視</label>

                                    <input name="<?= $r['role_id'] ?>form" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editForm" autocomplete="off"  <?php isEdit($r['form']) ?> onclick="allCheck('<?= $r['role_id'] ?>formCheckAll','<?= $r['role_id'] ?>form')">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editForm">編輯</label>

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
                          <button type="submit" class="btn btn-outline-info">編輯</button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
                <!-- edit form end -->
                <td class="d-flex justify-content-center">
                  <a href="javascript: deleteOne(<?= $r['role_id'] ?>)" class="vstack">
                    <i class="fa-solid fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <!-- Role List end -->
        <!-- 頁碼條 Start -->
        <nav aria-label="First group">
          <ul class="pagination">
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= 1 ?>">
                <i class="fa-solid fa-angles-left"></i>
              </a>
            </li>
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page - 1 ?>">
                <i class="fa-solid fa-angle-left"></i>
              </a>
            </li>
            <!-- 限制頁碼條 -->
            <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
              <?php if ($i >= 1 and $i <= $total_pages) : ?>
                <li class="page-item <?= $i != $page ?: 'active' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endif ?>
            <?php endfor ?>
            <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page + 1 ?>">
                <i class="fa-solid fa-angle-right"></i>
              </a>
            </li>
            <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $total_pages ?>">
                <i class="fa-solid fa-angles-right"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- 頁碼條 end -->
      </div>
    </div>
  </div>
</div>
<!-- Table End -->

<?php include __DIR__ . '/parts/footer.php' ?>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
  const checkAll = (CheckAll, setGroupName) => {
    let checkboxs = document.getElementsByName(setGroupName);
    for (let i = 0; i < checkboxs.length; i++) {
      checkboxs[i].checked = CheckAll.checked;
    }
  }

  const allCheck = (checkAll, setGroup) => {
    let checkboxs = document.getElementsByName(setGroup);
    let checkswitch = document.getElementById(checkAll);
    if (checkboxs[0].checked && checkboxs[1].checked) {
      return checkswitch.checked = true;
    } else {
      return checkswitch.checked = false;
    }
  }

  const deleteOne = (role_id) => {
    if (confirm(`是否要刪除編號為${role_id}的項目`)) {
      location.href = `roleList-delete.php?role_id=${role_id}`;
    } else {
      return
    }
  }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>