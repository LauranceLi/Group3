<?php
require __DIR__ . '/part/html-head.php';
// require __DIR__ . '/part/pdo-connect.php';
?>
<style>


</style>
<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary,navbar bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/Myfrom/main.php">綜合表單</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            ALL Form List Area
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">團體行程報名表單</a></li>
            <li><a class="dropdown-item" href="#">興趣表單</a></li>
            <li><a class="dropdown-item" href="#">講座表單</a></li>
            <li><a class="dropdown-item" href="#">客製化表單</a></li>
            <li><a class="dropdown-item" href="#">服務預約表單</a></li>
          </ul>
      </ul>
      
    </div>
  </div>
</nav> -->



<a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
  按我展開表單列表
</a>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">總表單欄列區</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="dropdown mt-3">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        點擊(下有列表)
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../Myfrom/group_form/group_list.php">團體行程報名表單</a></li>
        <li><a class="dropdown-item" href="../Myfrom/speech_form/speech_list.php">講座表單</a></li>
        <li><a class="dropdown-item" href="../Myfrom/interest_form/interest_list.php">興趣表單</a></li>
        <li><a class="dropdown-item" href="../Myfrom/customization_form/customization_list.php">客製化表單</a></li>
        <li><a class="dropdown-item" href="../Myfrom/serve_form/serve_list.php">服務預約表單</a></li>
      </ul>
      <hr/>
    </div>
  </div>
</div>


<?php require __DIR__ . '/part/html-foot.php';?>