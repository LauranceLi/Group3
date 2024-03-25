<?php

session_start();
$title = "無權限";
$pageName = 'noAuthority';

?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
    <meta charset="utf-8">
    <title><?= empty($title) ? '第三小组專题' : "$title - 第三小组專题" ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .sidebar {
            overflow: hidden;
        }

        .noAuthority {
            background-color: black !important;
            pointer-events: none !important;
            border: 0;
            opacity: 0.3 !important;
            user-select: none;
        }

        a.noAuthority:hover,
        a.disabled:hover {

            cursor: not-allowed;
            /* 禁止鼠标点击事件 */
        }

        .disabled {
            pointer-events: none !important;
            opacity: 0.3 !important;
            user-select: none;
        }

        /* #shipping_date {
            color: red;
        } */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>
</head>
<body>
<div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        <!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="homepage.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa-solid fa-tree me-2"></i>締杉旅遊</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-3">

            <div class="ms-3">
                <h4 class="mb-0"><?=$_SESSION['admin']['employee_nickname']?></h4>
                <span><?=$_SESSION['admin']['role_name']?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="../homepage/homepage.php" class="nav-item nav-link <?=$pageName == 'homepage' ? 'active' : ''?> "><i class="fa-solid fa-house-user me-2"></i>歡迎回来</a>
            <a href="../roleList/roleList.php" class="nav-item nav-link <?=$pageName == 'roleList' ? 'active' : ''?> <?=$_SESSION['permission']['role_set']?>"><i class="fa-solid fa-shield-halved me-2"></i>角色權限管理</a>
            <a href="../employees/employees.php" class="nav-item nav-link <?=$pageName == 'employees' ? 'active' : ''?> <?=$_SESSION['permission']['employees']?>"><i class="fa-solid fa-circle-user me-2"></i>員工管理</a>
            <a href="../members/members.php" class="nav-item nav-link <?=$pageName == 'members' ? 'active' : ''?> <?=$_SESSION['permission']['members']?>"><i class="fa-solid fa-users me-2"></i>會員管理</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?=$_SESSION['permission']['points']?>" data-bs-toggle="dropdown"><i class="fa-solid fa-star-half-stroke me-2"></i>積分管理</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="points_details.php" class="dropdown-item">積分明細</a>
                    <a href="points_changes.php" class="dropdown-item">積分操作</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <?php if ($pageName == 'itinerary' || $pageName == 'itinerary_order') {
                    $isItineraryActive = 'active';
                    $isItineraryExpand = 'true';
                    $isItineraryProper = 'none';
                    $isItineraryShow = 'show';
                }else {
                    $isItineraryActive = '';
                    $isItineraryExpand = 'false';
                    $isItineraryProper = '';
                }
                ?>
                <a href="#" class="nav-link dropdown-toggle <?=$isItineraryActive?> <?=$_SESSION['permission']['itinerary']?>" data-bs-toggle="dropdown"><i class="fa-solid fa-book me-2"></i>套裝管理</a>

                <div class="dropdown-menu bg-transparent border-0 <?= $isItineraryShow?>">
                    <a href="../itinerary/itinerary.php" class="dropdown-item <?=$pageName == 'itinerary' ? 'active show' : ''?>" aria-expanded="<?= $isItineraryExpand?>" data-bs-popper="<?= $isItineraryProper?>">套裝行程</a>

                    <a href="../itinerary_order/itinerary_order.php" class="dropdown-item <?=$pageName == 'itinerary_order' ? 'active show' : ''?>" aria-expanded="<?= $isItineraryExpand?>" data-bs-popper="<?= $isItineraryProper?>">套裝訂單</a>
                </div>
            </div>


            <a href="../order/orderList.php" class="nav-item nav-link <?=$pageName == 'orderList' ? 'active' : ''?> <?=$_SESSION['permission']['orders']?>"><i class="fa-solid fa-sack-dollar me-2"></i>訂單管理</a>
            <a href="../products/products.php" class="nav-item nav-link <?=$pageName == 'products' ? 'active' : ''?> <?=$_SESSION['permission']['products']?>"><i class="fa-solid fa-bag-shopping me-2"></i>商品上架管理</a>

            <div class="nav-item dropdown">
                <?php if ($pageName == 'groupForm' || $pageName == 'speechForm'  || $pageName == 'customizationForm'  || $pageName == 'interestForm'  || $pageName == 'serveForm') {
                    $isFormActive = 'active';
                    $isFormExpand = 'true';
                    $isFormProper = 'none';
                    $isFormShow = 'show';
                }else {
                    $isFormActive = '';
                    $isFormExpand = 'false';
                    $isFormProper = '';
                }
                ?>
                <a href="#" class="nav-link dropdown-toggle <?=$isFormActive?> <?=$_SESSION['permission']['form']?>" data-bs-toggle="dropdown"><i class="fa-solid fa-rectangle-list me-2"></i>表單管理</a>

                <div class="dropdown-menu bg-transparent border-0 <?= $isFormShow?>">
                    <a href="../group_form/group_list.php" class="dropdown-item <?=$pageName == 'groupForm' ? 'active show' : ''?>" aria-expanded="<?= $isFormExpand?>" data-bs-popper="<?= $isFormProper?>">團體表單</a>

                    <a href="../speech_form/speech_list.php" class="dropdown-item <?=$pageName == 'speechForm' ? 'active show' : ''?>" aria-expanded="<?= $isFormExpand?>" data-bs-popper="<?= $isFormProper?>">講座表單</a>
                    <a href="../customization_form/customization_list.php" class="dropdown-item <?=$pageName == 'customizationForm' ? 'active' : ''?>" aria-expanded="<?= $isFormExpand?>" data-bs-popper="<?= $isFormProper?>">客製化表單</a>
                    <a href="../interest_form/interest_list.php" class="dropdown-item <?=$pageName == 'interestForm' ? 'active show' : ''?>" aria-expanded="<?= $isFormExpand?>" data-bs-popper="<?= $isFormProper?>">興趣表單</a>
                    <a href="../serve_form/serve_list.php" class="dropdown-item <?=$pageName == 'serveForm' ? 'active show' : ''?>" aria-expanded="<?= $isFormExpand?>" data-bs-popper="<?= $isFormProper?>">服務預約表單</a>
                </div>
            </div>


        </div>
    </nav>
</div>
<!-- Sidebar End -->
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex"><?= $_SESSION['admin']['employee_nickname'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="signOut.php" class="dropdown-item">Sign Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

<!-- error Start -->
<div class="container-fluid ">
  <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
    <div class="col-md-6 text-center p-4">
      <i class="fa-solid fa-circle-check display-1 text-primary"></i>
      <h3 class="mb-4 mt-4">您沒有瀏覽此功能的權限。</h3>
      <p>將在 <span id="countdown">3</span> 秒後跳轉回首頁</p>
    </div>
  </div>
</div>
<!-- error End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">締杉旅遊</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="lib/chart/chart.min.js"></script>

    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://kit.fontawesome.com/f3c3056260.js" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
<script>
  let seconds = 3;
  const countdown = () => {
    seconds--;
    document.getElementById("countdown").textContent = seconds;
    if (seconds <= 0) {
      // 跳轉到新頁面
      window.location.href = "./homepage/homepage.php";
      clearInterval(timer); // 停止倒數計時器
    }
  }

  // 每秒呼叫倒數函數
  var timer = setInterval(countdown, 1000);
  
</script>
</body>

</html>