<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa-solid fa-tree me-2"></i>締杉旅遊</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?=$_SESSION['admin']['employee_nickname']?></h6>
                <span><?=$_SESSION['admin']['role_name']?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index_.php" class="nav-item nav-link <?=$pageName == 'index' ? 'active' : ''?>"><i class="fa-solid fa-house-user me-2"></i>歡迎回来</a>
            <a href="roleList.php" class="nav-item nav-link <?=$pageName == 'roleList' ? 'active' : ''?>"><i class="fa-solid fa-shield-halved me-2"></i>角色權限管理</a>
            <a href="employees.php" class="nav-item nav-link <?=$pageName == 'employees' ? 'active' : ''?>"><i class="fa-solid fa-circle-user me-2"></i>員工管理</a>
            <a href="members.php" class="nav-item nav-link <?=$pageName == 'members' ? 'active' : ''?>"><i class="fa-solid fa-users me-2"></i>會員管理</a>
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
                    <a href="crud_datatable_tcpdf_itinerary" class="dropdown-item">套裝行程</a>
                    <a href="crud_datatable_tcpdf_oder" class="dropdown-item">套裝訂單</a>
                </div>
            </div>


            <a href="" class="nav-item nav-link <?=$pageName == '' ? 'active' : ''?>"><i class="fa-solid fa-sack-dollar me-2"></i>訂單管理</a>
            <a href="" class="nav-item nav-link <?=$pageName == '' ? 'active' : ''?>"><i class="fa-solid fa-bag-shopping me-2"></i>商品上架管理</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-rectangle-list me-2"></i>表單管理</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="" class="dropdown-item">團體表單</a>
                    <a href="" class="dropdown-item">講座表單</a>
                    <a href="" class="dropdown-item">客製化表單</a>
                    <a href="" class="dropdown-item">興趣表單</a>
                    <a href="" class="dropdown-item">服務預約表單</a>
                </div>
            </div>


        </div>
    </nav>
</div>
<!-- Sidebar End -->