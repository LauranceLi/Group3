<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa-solid fa-tree me-2"></i>締杉旅遊</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">

            <div class="ms-3">
                <h4 class="mb-0"><?=$_SESSION['admin']['employee_nickname']?></h4>
                <span><?=$_SESSION['admin']['role_name']?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="../../homepage/homepage.php" class="nav-item nav-link <?=$pageName == 'homepage' ? 'active' : ''?>"><i class="fa-solid fa-house-user me-2"></i>歡迎回来</a>
            <a href="../../roleList/roleList.php" class="nav-item nav-link <?=$pageName == 'roleList' ? 'active' : ''?>"><i class="fa-solid fa-shield-halved me-2"></i>角色權限管理</a>
            <a href="../../employees/employees.php" class="nav-item nav-link <?=$pageName == 'employees' ? 'active' : ''?>"><i class="fa-solid fa-circle-user me-2"></i>員工管理</a>
            <a href="../../members/members.php" class="nav-item nav-link <?=$pageName == 'members' ? 'active' : ''?>"><i class="fa-solid fa-users me-2"></i>會員管理</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-star-half-stroke me-2"></i>積分管理</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="points_details.php" class="dropdown-item">積分明細</a>
                    <a href="points_changes.php" class="dropdown-item">積分操作</a>
                </div>
            </div>


            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-book me-2"></i>套裝管理</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="../../itinerary/itinerary.php" class="dropdown-item">套裝行程</a>
                    <a href="../../itinerary_order/itinerary_order.php" class="dropdown-item">套裝訂單</a>
                </div>
            </div>


            <a href="../../order/orderList.php" class="nav-item nav-link <?=$pageName == 'orderList' ? 'active' : ''?>"><i class="fa-solid fa-sack-dollar me-2"></i>訂單管理</a>
            <a href="" class="nav-item nav-link <?=$pageName == '' ? 'active' : ''?>"><i class="fa-solid fa-bag-shopping me-2"></i>商品上架管理</a>

            <div class="nav-item dropdown">
                <?php if ($pageName == 'groupList' || $pageName == 'speechList'  || $pageName == 'customizationList'  || $pageName == 'interestList'  || $pageName == 'serveList') {
                    $isActive = 'active';
                    $isExpand = 'true';
                    $isProper = 'none';
                    $isShow = 'show';
                }else {
                    $isActive = '';
                    $isExpand = 'false';
                    $isProper = '';
                }
                ?>
                <a href="#" class="nav-link dropdown-toggle <?=$isActive?>" data-bs-toggle="dropdown"><i class="fa-solid fa-rectangle-list me-2"></i>表單管理</a>

                <div class="dropdown-menu bg-transparent border-0 <?= $isShow?>">
                    <a href="../group_form/group_list.php" class="dropdown-item <?=$pageName == 'groupList' ? 'active show' : ''?>" aria-expanded="<?= $isExpand?>" data-bs-popper="<?= $isProper?>">團體表單</a>

                    <a href="../speech_form/speech_list.php" class="dropdown-item <?=$pageName == 'speechList' ? 'active show' : ''?>" aria-expanded="<?= $isExpand?>" data-bs-popper="<?= $isProper?>">講座表單</a>
                    <a href="../customization_form/customization_list.php" class="dropdown-item <?=$pageName == 'customizationList' ? 'active' : ''?>" aria-expanded="<?= $isExpand?>" data-bs-popper="<?= $isProper?>">客製化表單</a>
                    <a href="../interest_form/interest_list.php" class="dropdown-item <?=$pageName == 'interestList' ? 'active show' : ''?>" aria-expanded="<?= $isExpand?>" data-bs-popper="<?= $isProper?>">興趣表單</a>
                    <a href="../serve_form/serve_list.php" class="dropdown-item <?=$pageName == 'serveList' ? 'active show' : ''?>" aria-expanded="<?= $isExpand?>" data-bs-popper="<?= $isProper?>">服務預約表單</a>
                </div>
            </div>


        </div>
    </nav>
</div>
<!-- Sidebar End -->