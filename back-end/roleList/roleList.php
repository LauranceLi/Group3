<?php
require '../parts/pdo_connect.php';
session_start();
$title = "Role List";
$pageName = 'roleList';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// $isAbled = $_SESSION['permission']['role_set'] == 'view' ? 'disabled' : '';
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

# 每一頁有幾筆
$per_page = 10;






$permission_sql =
  sprintf(
  "SELECT *
  FROM permission
  INNER JOIN role_set
  ON role_set.role_id = permission.role_id
  ORDER BY permission.role_id ASC LIMIT %s, %s",
    ($page - 1) * $per_page,
    $per_page
  );

$permission_result = $conn->query($permission_sql);


class Permission
{
  public $create;
  public $read;
  public $update;
  public $delete;

  public function __construct($create, $read, $update, $delete)
  {
    $this->create = $create;
    $this->read = $read;
    $this->update = $update;
    $this->delete = $delete;
  }
}

function permitted_icon($permission)
{
  $icons = array(
    'createIcon' => '',
    'readIcon' => '',
    'updateIcon' => '',
    'deleteIcon' => ''
  );
  $check = '<i class="fa-solid fa-circle-check"></i>';
  $permissions = explode(',', $permission);
  $icons['createIcon'] = in_array('C', $permissions) ? $check : '';
  $icons['readIcon'] = in_array('R', $permissions) ? $check : '';
  $icons['updateIcon'] = in_array('U', $permissions) ? $check : '';
  $icons['deleteIcon'] = in_array('D', $permissions) ? $check : '';

  return $icons;
}



function isView($item)
{
  if ($item == 'view' || $item == 'edit') {
    echo 'checked="true"';
  } else {
    echo '';
  }
}
function isEdit($item)
{
  if ($item == 'edit') {
    echo 'checked="true"';
  } else {
    echo '';
  }
}




?>


<?php include '../parts/html-head.php' ?>
<style>
  table {
    table-layout: fixed;
  }
</style>

<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>





<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-12 col-xl-12">
      <div class="bg-secondary rounded h-100 p-4 ">
        <div class="roleListTitleBox d-flex justify-content-between">
          <h3 class="mb-3">角色權限一覽</h3>
          <!-- add form start -->
          <button type="button" class="btn btn-outline-info mb-3 " data-bs-toggle="modal" data-bs-target="#addBackdrop">新增</button>
          <div class="modal fade " id="addBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content bg-secondary border-0">
                <?php include './php/role-add-form.php' ?>

              </div>
            </div>
          </div>
          <!-- add form end -->
        </div>

        <div class="description">
          <p>說明：<i class="fa-solid fa-pen-to-square me-1"></i>可供編輯、<i class="fa-solid fa-eye me-1"></i>僅供檢視、<i class="fa-solid fa-square-xmark me-1"></i>無任何權限</p>
        </div>


        <!-- Role List Start -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" class="text-center">角色名稱</th>
              <?php
              foreach ($roleSetInputs as $roleSetInput) {
                $roleSetTitle = $roleSetInput->roleSetCh;
                echo '<th scope="col" class="text-center" colspan="4">' . $roleSetTitle . '</th>';
              }
              ?>
              <th scope="col" class="text-center">編輯</th>
              <th scope="col" class="text-center">刪除</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">權限</td>
              <?php foreach ($roleSetInputs as $roleSetInput) : ?>
                <td class="text-center"><i class="fa-solid fa-file-circle-plus"></i></td>
                <td class="text-center"><i class="fa-solid fa-eye"></i></td>
                <td class="text-center"><i class="fa-solid fa-pen-to-square"></i></td>
                <td class="text-center"><i class="fa-solid fa-trash-can"></i></td>
              <?php endforeach ?>
              <td class="text-center"><i class="fa-solid fa-pen-to-square"></i></td>
              <td class="text-center"><i class="fa-solid fa-trash-can"></i></td>

            </tr>



            <?php foreach ($permission_result as $r) : ?>
              <tr>
                <td class="text-center"><?= $r['role_ch'] ?></td>
                <?php 
                $columnName = ['role_set', 'employees', 'members', 'orders', 'products','form',  'itinerary','points'];
                foreach ($columnName as $type) : ?>
                  <?php $permittedIcons = permitted_icon($r[$type]); ?>
                  <td><?= $permittedIcons['createIcon'] ?></td>
                  <td><?= $permittedIcons['readIcon'] ?></td>
                  <td><?= $permittedIcons['updateIcon'] ?></td>
                  <td><?= $permittedIcons['deleteIcon'] ?></td>
                  
                <?php endforeach ?>
                <td class="text-center">
                  <a href="#" class="vstack <?= $isAbled ?>" data-bs-toggle="modal" data-bs-target="#editBackdrop<?= $r['role_id'] ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </td>
                <!-- edit form start -->
                <?php
                $role_id = $r['role_id'];

                $edit_sql = "SELECT *
                            FROM permission
                            INNER JOIN role_set
                            ON role_set.role_id = permission.role_id
                            WHERE permission.role_id = '$role_id' ";
                $edit_sql_result = $conn->query($edit_sql)->fetch_assoc();
                $edit_name = $edit_sql_result['role_ch'];
                ?>
                <div class="modal fade " id="editBackdrop<?= $r['role_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-secondary border-0">
                      <form action="roleList-edit.php?role_id=<?= $r['role_id'] ?>" method="post" id="editFormBox">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editLabel">編輯角色</h5>
                        </div>
                        <div class="modal-body ">
                          <h6>角色名稱</h6>
                          <div class="input-group mb-3">

                            <input type="text" class="form-control" name="new_role_ch" value="<?= $edit_sql_result['role_ch'] ?>" readonly>
                          </div>

                          <div class="permissionBox d-flex justify-content-between">
                            <div class="permissionBoxLeft">
                              <div class="permissionItem m-3 ">
                                <h6>角色設置</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="1" type="checkbox" role="switch" id="<?= $r['role_id'] ?>roleSetCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>roleSet[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>roleSetCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>roleSet[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewRoleSet" autocomplete="off" <?php isView($r['role_set']) ?> onclick="allCheck('<?= $r['role_id'] ?>roleSetCheckAll','<?= $r['role_id'] ?>roleSet[]') " value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewRoleSet">檢視</label>

                                    <input name="<?= $r['role_id'] ?>roleSet[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editRoleSet" autocomplete="off" <?php isEdit($r['role_set']) ?> onclick="allCheck('<?= $r['role_id'] ?>roleSetCheckAll','<?= $r['role_id'] ?>roleSet[]')" value="edit">

                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editRoleSet">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>員工管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="2" type="checkbox" role="switch" id="<?= $r['role_id'] ?>employeesCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>employee[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>employeesCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>employee[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewEmployee" autocomplete="off" <?php isView($r['employees']) ?> onclick="allCheck('<?= $r['role_id'] ?>employeesCheckAll','<?= $r['role_id'] ?>employee[]')" value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewEmployee">檢視</label>

                                    <input name="<?= $r['role_id'] ?>employee[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editEmployee" autocomplete="off" <?php isEdit($r['employees']) ?> onclick="allCheck('<?= $r['role_id'] ?>employeesCheckAll','<?= $r['role_id'] ?>employee[]')" value="edit">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editEmployee">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>會員管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="3" type="checkbox" role="switch" id="<?= $r['role_id'] ?>membersCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>member[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>membersCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>member[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewMember" autocomplete="off" <?php isView($r['members']) ?> onclick="allCheck('<?= $r['role_id'] ?>membersCheckAll','<?= $r['role_id'] ?>member[]')" value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewMember">檢視</label>

                                    <input name="<?= $r['role_id'] ?>member[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editMember" autocomplete="off" <?php isEdit($r['members']) ?> onclick="allCheck('<?= $r['role_id'] ?>membersCheckAll','<?= $r['role_id'] ?>member[]')" value="edit">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editMember">編輯</label>

                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>積分管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="4" type="checkbox" role="switch" id="<?= $r['role_id'] ?>pointsCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>point[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>pointsCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>point[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewPoint" autocomplete="off" <?php isView($r['points']) ?> onclick="allCheck('<?= $r['role_id'] ?>pointsCheckAll','<?= $r['role_id'] ?>point[]')" value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewPoint">檢視</label>

                                    <input name="<?= $r['role_id'] ?>point[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editPoint" autocomplete="off" <?php isEdit($r['points']) ?> onclick="allCheck('<?= $r['role_id'] ?>pointsCheckAll','<?= $r['role_id'] ?>point[]')" value="edit">
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
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="5" type="checkbox" role="switch" id="<?= $r['role_id'] ?>itineraryCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>itinerary[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>itineraryCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>itinerary[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewItinerary" autocomplete="off" <?php isView($r['itinerary']) ?> onclick="allCheck('<?= $r['role_id'] ?>itineraryCheckAll','<?= $r['role_id'] ?>itinerary[]')" value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewItinerary">檢視</label>

                                    <input name="<?= $r['role_id'] ?>itinerary[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editItinerary" autocomplete="off" <?php isEdit($r['itinerary']) ?> onclick="allCheck('<?= $r['role_id'] ?>itineraryCheckAll','<?= $r['role_id'] ?>itinerary[]')" value="edit">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editItinerary">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>訂單管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="6" type="checkbox" role="switch" id="<?= $r['role_id'] ?>ordersCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>order[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>ordersCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>order[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewOrder" autocomplete="off" <?php isView($r['orders']) ?> onclick="allCheck('<?= $r['role_id'] ?>ordersCheckAll','<?= $r['role_id'] ?>order[]')" value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewOrder">檢視</label>

                                    <input name="<?= $r['role_id'] ?>order[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editOrder" autocomplete="off" <?php isEdit($r['orders']) ?> onclick="allCheck('<?= $r['role_id'] ?>ordersCheckAll','<?= $r['role_id'] ?>order[]')" value="edit">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editOrder">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>商品上架管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="7" type="checkbox" role="switch" id="<?= $r['role_id'] ?>productsCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>product[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>productsCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>product[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewProduct" autocomplete="off" <?php isView($r['products']) ?> onclick="allCheck('<?= $r['role_id'] ?>productsCheckAll','<?= $r['role_id'] ?>product[]')" value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewProduct">檢視</label>

                                    <input name="<?= $r['role_id'] ?>product[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editProduct" autocomplete="off" <?php isEdit($r['products']) ?> onclick="allCheck('<?= $r['role_id'] ?>productsCheckAll','<?= $r['role_id'] ?>product[]')" value="edit">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editProduct">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>表單管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="<?= $r['role_id'] ?>isAuthorized[]" value="8" type="checkbox" role="switch" id="<?= $r['role_id'] ?>formCheckAll" onclick="checkAll(this,'<?= $r['role_id'] ?>form[]')">
                                    <label class="form-check-label " for="<?= $r['role_id'] ?>formCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="<?= $r['role_id'] ?>form[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>viewForm" autocomplete="off" <?php isView($r['form']) ?> onclick="allCheck('<?= $r['role_id'] ?>formCheckAll','<?= $r['role_id'] ?>form[]')" value="view">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>viewForm">檢視</label>

                                    <input name="<?= $r['role_id'] ?>form[]" type="checkbox" class="btn-check" id="<?= $r['role_id'] ?>editForm" autocomplete="off" <?php isEdit($r['form']) ?> onclick="allCheck('<?= $r['role_id'] ?>formCheckAll','<?= $r['role_id'] ?>form[]')" value="edit">
                                    <label class="btn btn-outline-info" for="<?= $r['role_id'] ?>editForm">編輯</label>

                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-floating m-3">
                              <h6>相關描述</h6>
                              <textarea class="form-control p-2" name="<?= $r['role_id'] ?>edit_role_desc" id="<?= $r['role_id'] ?>edit_role_desc" style="min-height: 91%"></textarea>
                              <label for="<?= $r['role_id'] ?>edit_role_desc"></label>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                          <button type="submit" class="btn btn-outline-info" onclick="editOne(<?= $r['role_id'] ?>)">編輯</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- edit form end -->
                <td class="text-center">
                  <a href="javascript: deleteOne(<?= $r['role_id'] ?>)" class="vstack ">
                    <i class="fa-solid fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <!-- Role List end -->
        <!-- 頁碼條 Start -->
        <?php include '../parts/pagination.php' ?>
        <!-- 頁碼條 end -->
      </div>
    </div>
  </div>
</div>
<!-- Table End -->

<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<script src="./js/checkAll.js"></script>
<script src="./js/deleteOne.js"></script>


<?php include '../parts/html-foot.php' ?>