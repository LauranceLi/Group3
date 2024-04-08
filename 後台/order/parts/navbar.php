<?php if (!isset($pageName)) {
  $pageName = '';
};
?>
<style>
        form {
            background-color: transparent;
        }
</style>
<div class="container">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= $pageName == 'list' ? 'active' : '' ?>" href="orderList.php">訂單列表</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $pageName == 'add' ? 'active' : '' ?>" href="add.php">新增訂單</a>
          </li>
        </ul>


      </div>
    </div>
  </nav>
</div>