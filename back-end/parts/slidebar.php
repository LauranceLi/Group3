<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="homepage.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa-solid fa-tree me-2"></i>締杉旅遊</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-3">

            <div class="ms-3">
                <h4 class="mb-0"><?= $_SESSION['admin']['employee_nickname'] ?></h4>
                <p><?= $_SESSION['admin']['department_ch'] ?> <?= $_SESSION['admin']['title_ch'] ?></p>
            </div>
        </div>
        <div class="navbar-nav w-100">
        <?php
                class Page {
                    public $pageId;
                    public $pageIcon;
                    public $pageCh;
                
                    public function __construct($pageId, $pageIcon, $pageCh) {
                        $this->pageIcon = $pageIcon;
                        $this->pageId = $pageId;
                        $this->pageCh = $pageCh;
                    }
                }
                
                $pages = [
                    new Page('homepage', '<i class="fa-solid fa-house-user me-2"></i>', '歡迎回來'),
                    new Page('roleList', '<i class="fa-solid fa-shield-halved me-2"></i>', '角色權限管理'),
                    new Page('employees', '<i class="fa-solid fa-circle-user me-2"></i>', '員工管理'),
                    new Page('members', '<i class="fa-solid fa-users me-2"></i>', '會員管理'),
                    new Page('orderList', '<i class="fa-solid fa-sack-dollar me-2"></i>', '訂單管理'),
                    new Page('products', '<i class="fa-solid fa-shopping-bag me-2"></i>', '商品上架管理'),
                    new Page('lectureList', '<i class="fa-solid fa-rectangle-list me-2"></i>', '講座管理'),
                ];
                
                foreach ($pages as $page) {
                    $address = '../' . $page->pageId . '/'. $page->pageId . '.php';
                    $icon = $page->pageIcon;
                    $name = $page->pageCh;
                    $pageStatus = ($page->pageId == $pageName) ? 'active' : '';
                    echo "<a href='$address' class='nav-item nav-link $pageStatus'>$icon $name</a>";
                }
                ?>



            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-star-half-stroke me-2"></i>積分管理</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="points_details.php" class="dropdown-item">積分明細</a>
                    <a href="points_changes.php" class="dropdown-item">積分操作</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= $isItineraryActive ?>" data-bs-toggle="dropdown"><i class="fa-solid fa-book me-2"></i>套裝管理</a>

                <div class="dropdown-menu bg-transparent border-0 <?= $isItineraryShow ?>">
                    <a href="../itinerary/itinerary.php" class="dropdown-item <?= $pageName == 'itinerary' ? 'active show' : '' ?>" aria-expanded="<?= $isItineraryExpand ?>" data-bs-popper="<?= $isItineraryProper ?>">套裝行程</a>

                    <a href="../itinerary_order/itinerary_order.php" class="dropdown-item <?= $pageName == 'itinerary_order' ? 'active show' : '' ?>" aria-expanded="<?= $isItineraryExpand ?>" data-bs-popper="<?= $isItineraryProper ?>">套裝訂單</a>
                </div>
            </div>



        </div>
    </nav>
</div>
<!-- Sidebar End -->