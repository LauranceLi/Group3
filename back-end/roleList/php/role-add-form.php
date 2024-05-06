<form action="roleList-add.php" method="post">
  <div class="modal-header">
    <h5 class="modal-title" id="addLabel">新增角色</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body ">
    <h6>角色名稱</h6>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="新建名稱" aria-label="Username" aria-describedby="basic-addon1" name="new_role_name" required>
    </div>
    <div class="permissionBox d-flex flex-wrap justify-content-between">
      <?php
      class RoleSetInput
      {
        public $roleSetCh;
        public $roleSetEn;

        public function __construct($roleSetCh, $roleSetEn)
        {
          $this->roleSetCh = $roleSetCh;
          $this->roleSetEn = $roleSetEn;
        }
      }
      class Action
      {
        public $actionCh;
        public $actionEn;

        public function __construct($actionCh, $actionEn)
        {
          $this->actionCh = $actionCh;
          $this->actionEn = $actionEn;
        }
      }

      $roleSetInputs = [
        new RoleSetInput('角色設置', 'roleSet'),
        new RoleSetInput('員工管理', 'employees'),
        new RoleSetInput('會員管理', 'members'),
        new RoleSetInput('訂單管理', 'orders'),
        new RoleSetInput('商品上架管理', 'products'),
        new RoleSetInput('講座管理', 'lectures'),
        new RoleSetInput('行程管理', 'itinerary'),
        new RoleSetInput('積分管理', 'points'),
      ];

      $actions = [
        new Action('新增', 'Create'),
        new Action('檢視', 'Read'),
        new Action('編輯', 'Update'),
        new Action('刪除', 'Delete'),
      ];

      foreach ($roleSetInputs as $roleSetInput) {
        $roleSetTitle = $roleSetInput->roleSetCh;
        $roleSetEn = $roleSetInput->roleSetEn;

        echo '<div class="permissionItem m-3 ">';
        echo "<h6>$roleSetTitle</h6>";
        echo '<div class="bg-secondary rounded h-75 p-1 d-flex">';
        echo '<div class="form-check form-switch me-4 d-flex align-items-center">';
        echo '<input class="form-check-input me-2" name="isAuthorized[]" type="checkbox" role="switch" id=' . $roleSetEn . 'CheckAll" onclick="checkAll(this,' . $roleSetEn . '[])">';
        echo '<label class="form-check-label " for=' . $roleSetEn . 'CheckAll">全選</label>';
        echo '</div>';
        echo '<div class="btn-group" role="group">';

        foreach ($actions as $action) {
          $actionCh = $action->actionCh;
          $actionEn = $action->actionEn;
          echo '<input name="' . $roleSetEn . '[]"  type="checkbox" class="btn-check" id="' . $roleSetEn . '" autocomplete="off" checked="true" onclick="allCheck(' . $roleSetEn . 'CheckAll,' . $roleSetEn . '[])">';
          echo '<label class="btn btn-outline-info d-flex align-items-center" for="' . $roleSetEn . $actionEn . '">' . $actionCh . '</label>';
        }
        echo '</div></div></div>';
      }
      ?>

    </div>
    <div class="permissionItem m-3">
      <h6>相關描述</h6>
      <textarea class="form-control p-2" name="new_role_desc" id="new_role_desc" style="min-height: 91%"></textarea>
      <label for="new_role_desc"></label>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-outline-info">新增</button>
  </div>
</form>