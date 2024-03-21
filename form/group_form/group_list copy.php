<?php 
include __DIR__ . '/../part/html-head2.php';
require __DIR__ . '/group_pdo-connect.php';  #附上資料庫連結



$page = isset($_GET['page']) ? intval($_GET['page']) : 1;   #轉換成整數
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

$perPage = 10;      #每頁幾項

$t_sql = "SELECT COUNT(1) FROM group_list";     #搜尋筆數
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; #總筆數
$totalPages = ceil($totalRows / $perPage);       #總頁數   
$rows = []; #預設為空陣列

if ($page > $totalPages) {                      #如當前頁數>總頁數
  header('Location: ?page=' . $totalPages);   #就會跳到最前或最後，然後結束
  exit;
}

$sql = sprintf("SELECT * FROM group_list LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll();
?>

<!-- 轉換成json文字，陣列呈現---註解中 -->
<!-- <div><?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?></div> -->

<!-- 把PHP的JSON轉換成JS的字串 。轉換資料，不是溝通。前後端分開不太適用-->
<script>
  const myRows = <?= $totalRows ?>;
</script>

<style>
  form .mb-3 .form-text {
    color: red;
  }
</style>


<div class="container-fluid position-relative d-flex p-0">
      <!-- Spinner Start -->
      <div
        id="spinner"
        class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
      >
        <div
          class="spinner-border text-primary"
          style="width: 3rem; height: 3rem"
          role="status"
        >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- Spinner End -->

      <!-- Sidebar Start -->
      <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
          <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
              <i class="fa fa-user-edit me-2"></i>DarkPan
            </h3>
          </a>
          <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
              <img
                class="rounded-circle"
                src="img/user.jpg"
                alt=""
                style="width: 40px; height: 40px"
              />
              <div
                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"
              ></div>
            </div>
            <div class="ms-3">
              <h6 class="mb-0">Jhon Doe</h6>
              <span>Admin</span>
            </div>
          </div>
          <div class="navbar-nav w-100">
            <a href="index.html" class="nav-item nav-link active"
              ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a
            >
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
                ><i class="fa fa-laptop me-2"></i>Elements</a
              >
              <div class="dropdown-menu bg-transparent border-0">
                <a href="button.html" class="dropdown-item">Buttons</a>
                <a href="typography.html" class="dropdown-item">Typography</a>
                <a href="element.html" class="dropdown-item">Other Elements</a>
              </div>
            </div>
            <a href="widget.html" class="nav-item nav-link"
              ><i class="fa fa-th me-2"></i>Widgets</a
            >
            <a href="form.html" class="nav-item nav-link"
              ><i class="fa fa-keyboard me-2"></i>Forms</a
            >
            <a href="table.html" class="nav-item nav-link"
              ><i class="fa fa-table me-2"></i>Tables</a
            >
            <a href="chart.html" class="nav-item nav-link"
              ><i class="fa fa-chart-bar me-2"></i>Charts</a
            >
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
                ><i class="far fa-file-alt me-2"></i>Pages</a
              >
              <div class="dropdown-menu bg-transparent border-0">
                <a href="signin.html" class="dropdown-item">Sign In</a>
                <a href="signup.html" class="dropdown-item">Sign Up</a>
                <a href="404.html" class="dropdown-item">404 Error</a>
                <a href="blank.html" class="dropdown-item">Group Page</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
      <!-- Sidebar End -->

      <!-- Content Start -->
      <div class="content">
        <!-- Navbar Start -->
        <nav
          class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0"
        >
          <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
          </a>
          <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
          </a>
          <form class="d-none d-md-flex ms-4">
            <input
              class="form-control bg-dark border-0"
              type="search"
              placeholder="Search"
            />
          </form>
          <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
              >
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0"
              >
                <a href="#" class="dropdown-item">
                  <div class="d-flex align-items-center">
                    <img
                      class="rounded-circle"
                      src="img/user.jpg"
                      alt=""
                      style="width: 40px; height: 40px"
                    />
                    <div class="ms-2">
                      <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                      <small>15 minutes ago</small>
                    </div>
                  </div>
                </a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item">
                  <div class="d-flex align-items-center">
                    <img
                      class="rounded-circle"
                      src="img/user.jpg"
                      alt=""
                      style="width: 40px; height: 40px"
                    />
                    <div class="ms-2">
                      <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                      <small>15 minutes ago</small>
                    </div>
                  </div>
                </a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item">
                  <div class="d-flex align-items-center">
                    <img
                      class="rounded-circle"
                      src="img/user.jpg"
                      alt=""
                      style="width: 40px; height: 40px"
                    />
                    <div class="ms-2">
                      <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                      <small>15 minutes ago</small>
                    </div>
                  </div>
                </a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item text-center"
                  >See all message</a
                >
              </div>
            </div>
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
              >
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notificatin</span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0"
              >
                <a href="#" class="dropdown-item">
                  <h6 class="fw-normal mb-0">Profile updated</h6>
                  <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item">
                  <h6 class="fw-normal mb-0">New user added</h6>
                  <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item">
                  <h6 class="fw-normal mb-0">Password changed</h6>
                  <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item text-center"
                  >See all notifications</a
                >
              </div>
            </div>
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
              >
                <img
                  class="rounded-circle me-lg-2"
                  src="img/user.jpg"
                  alt=""
                  style="width: 40px; height: 40px"
                />
                <span class="d-none d-lg-inline-flex">John Doe</span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0"
              >
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="#" class="dropdown-item">Log Out</a>
              </div>
            </div>
          </div>
        </nav>
        <!-- Navbar End -->

        <!-- Sale & Revenue Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
              <div
                class="bg-secondary rounded d-flex align-items-center justify-content-between p-4"
              >
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                  <p class="mb-2">Today Sale</p>
                  <h6 class="mb-0">$1234</h6>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div
                class="bg-secondary rounded d-flex align-items-center justify-content-between p-4"
              >
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                  <p class="mb-2">Total Sale</p>
                  <h6 class="mb-0">$1234</h6>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div
                class="bg-secondary rounded d-flex align-items-center justify-content-between p-4"
              >
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                  <p class="mb-2">Today Revenue</p>
                  <h6 class="mb-0">$1234</h6>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div
                class="bg-secondary rounded d-flex align-items-center justify-content-between p-4"
              >
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                  <p class="mb-2">Total Revenue</p>
                  <h6 class="mb-0">$1234</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Sale & Revenue End -->

        <!-- Sales Chart Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
              <div class="bg-secondary text-center rounded p-4">
                <div
                  class="d-flex align-items-center justify-content-between mb-4"
                >
                  <h6 class="mb-0">Worldwide Sales</h6>
                  <a href="">Show All</a>
                </div>
                <canvas id="worldwide-sales"></canvas>
              </div>
            </div>
            <div class="col-sm-12 col-xl-6">
              <div class="bg-secondary text-center rounded p-4">
                <div
                  class="d-flex align-items-center justify-content-between mb-4"
                >
                  <h6 class="mb-0">Salse & Revenue</h6>
                  <a href="">Show All</a>
                </div>
                <canvas id="salse-revenue"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- Sales Chart End -->

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h6 class="mb-0">Recent Salse</h6>
              <a href="">Show All</a>
            </div>
            <div class="table-responsive">
              <table
                class="table text-start align-middle table-bordered table-hover mb-0"
              >
                <thead>
                  <tr class="text-white">
                    <th scope="col">
                      <input class="form-check-input" type="checkbox" />
                    </th>
                    <th scope="col">Date</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input class="form-check-input" type="checkbox" /></td>
                    <td>01 Jan 2045</td>
                    <td>INV-0123</td>
                    <td>Jhon Doe</td>
                    <td>$123</td>
                    <td>Paid</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><input class="form-check-input" type="checkbox" /></td>
                    <td>01 Jan 2045</td>
                    <td>INV-0123</td>
                    <td>Jhon Doe</td>
                    <td>$123</td>
                    <td>Paid</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><input class="form-check-input" type="checkbox" /></td>
                    <td>01 Jan 2045</td>
                    <td>INV-0123</td>
                    <td>Jhon Doe</td>
                    <td>$123</td>
                    <td>Paid</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><input class="form-check-input" type="checkbox" /></td>
                    <td>01 Jan 2045</td>
                    <td>INV-0123</td>
                    <td>Jhon Doe</td>
                    <td>$123</td>
                    <td>Paid</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><input class="form-check-input" type="checkbox" /></td>
                    <td>01 Jan 2045</td>
                    <td>INV-0123</td>
                    <td>Jhon Doe</td>
                    <td>$123</td>
                    <td>Paid</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="">Detail</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Recent Sales End -->

        <!-- Widgets Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-4">
              <div class="h-100 bg-secondary rounded p-4">
                <div
                  class="d-flex align-items-center justify-content-between mb-2"
                >
                  <h6 class="mb-0">Messages</h6>
                  <a href="">Show All</a>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                  <img
                    class="rounded-circle flex-shrink-0"
                    src="img/user.jpg"
                    alt=""
                    style="width: 40px; height: 40px"
                  />
                  <div class="w-100 ms-3">
                    <div class="d-flex w-100 justify-content-between">
                      <h6 class="mb-0">Jhon Doe</h6>
                      <small>15 minutes ago</small>
                    </div>
                    <span>Short message goes here...</span>
                  </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                  <img
                    class="rounded-circle flex-shrink-0"
                    src="img/user.jpg"
                    alt=""
                    style="width: 40px; height: 40px"
                  />
                  <div class="w-100 ms-3">
                    <div class="d-flex w-100 justify-content-between">
                      <h6 class="mb-0">Jhon Doe</h6>
                      <small>15 minutes ago</small>
                    </div>
                    <span>Short message goes here...</span>
                  </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                  <img
                    class="rounded-circle flex-shrink-0"
                    src="img/user.jpg"
                    alt=""
                    style="width: 40px; height: 40px"
                  />
                  <div class="w-100 ms-3">
                    <div class="d-flex w-100 justify-content-between">
                      <h6 class="mb-0">Jhon Doe</h6>
                      <small>15 minutes ago</small>
                    </div>
                    <span>Short message goes here...</span>
                  </div>
                </div>
                <div class="d-flex align-items-center pt-3">
                  <img
                    class="rounded-circle flex-shrink-0"
                    src="img/user.jpg"
                    alt=""
                    style="width: 40px; height: 40px"
                  />
                  <div class="w-100 ms-3">
                    <div class="d-flex w-100 justify-content-between">
                      <h6 class="mb-0">Jhon Doe</h6>
                      <small>15 minutes ago</small>
                    </div>
                    <span>Short message goes here...</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
              <div class="h-100 bg-secondary rounded p-4">
                <div
                  class="d-flex align-items-center justify-content-between mb-4"
                >
                  <h6 class="mb-0">Calender</h6>
                  <a href="">Show All</a>
                </div>
                <div id="calender"></div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
              <div class="h-100 bg-secondary rounded p-4">
                <div
                  class="d-flex align-items-center justify-content-between mb-4"
                >
                  <h6 class="mb-0">To Do List</h6>
                  <a href="">Show All</a>
                </div>
                <div class="d-flex mb-2">
                  <input
                    class="form-control bg-dark border-0"
                    type="text"
                    placeholder="Enter task"
                  />
                  <button type="button" class="btn btn-primary ms-2">
                    Add
                  </button>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                  <input class="form-check-input m-0" type="checkbox" />
                  <div class="w-100 ms-3">
                    <div
                      class="d-flex w-100 align-items-center justify-content-between"
                    >
                      <span>Short task goes here...</span>
                      <button class="btn btn-sm">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                  <input class="form-check-input m-0" type="checkbox" />
                  <div class="w-100 ms-3">
                    <div
                      class="d-flex w-100 align-items-center justify-content-between"
                    >
                      <span>Short task goes here...</span>
                      <button class="btn btn-sm">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                  <input class="form-check-input m-0" type="checkbox" checked />
                  <div class="w-100 ms-3">
                    <div
                      class="d-flex w-100 align-items-center justify-content-between"
                    >
                      <span><del>Short task goes here...</del></span>
                      <button class="btn btn-sm text-primary">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                  <input class="form-check-input m-0" type="checkbox" />
                  <div class="w-100 ms-3">
                    <div
                      class="d-flex w-100 align-items-center justify-content-between"
                    >
                      <span>Short task goes here...</span>
                      <button class="btn btn-sm">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center pt-2">
                  <input class="form-check-input m-0" type="checkbox" />
                  <div class="w-100 ms-3">
                    <div
                      class="d-flex w-100 align-items-center justify-content-between"
                    >
                      <span>Short task goes here...</span>
                      <button class="btn btn-sm">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Widgets End -->

        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="bg-secondary rounded-top p-4">
            <div class="row">
              <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">Your Site Name</a>, All Right Reserved.
              </div>
              <div class="col-12 col-sm-6 text-center text-sm-end">
                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                <br />Distributed By:
                <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer End -->
      </div>
      <!-- Content End -->

      <!-- Back to Top -->
      <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
        ><i class="bi bi-arrow-up"></i
      ></a>
    </div>

<script>
  const {
    group_id: groupidField,
    name: nameField,
    nameid: nameidField,
    birthday: birthdayField,
    email: emailField,
    mobile: mobileField,
    address: addressField
  } = document.form1;


  function sendData(e) {

    // 欄位的外觀要回復原來的狀態
    groupidField.style.border = "1px solid #CCC";
    groupidField.nextElementSibling.innerHTML = '';
    nameField.style.border = "1px solid #CCC";
    nameField.nextElementSibling.innerHTML = '';
    nameidField.style.border = "1px solid #CCC";
    nameidField.nextElementSibling.innerHTML = '';
    birthdayField.style.border = "1px solid #CCC";
    birthdayField.nextElementSibling.innerHTML = '';
    emailField.style.border = "1px solid #CCC";
    emailField.nextElementSibling.innerHTML = '';
    mobileField.style.border = "1px solid #CCC";
    mobileField.nextElementSibling.innerHTML = '';
    addressField.style.border = "1px solid #CCC";
    addressField.nextElementSibling.innerHTML = '';

    e.preventDefault(); //不要讓表單以傳統的方式送出

    // 判斷有無通過檢查，預true，紅框+套入正規化
    let isPass = true;
    //groupid必填，檢查格式，空白錯誤
    if (!validategroup_id(groupidField.value) || groupidField.value === '' || !/^\d+$/.test(groupidField.value) ||
      !(parseInt(groupidField.value) >= 0 && parseInt(groupidField.value) <= 99)) {
      isPass = false;
      groupidField.style.border = "2px solid red";
      groupidField.nextElementSibling.innerHTML = '請輸入正確的行程編號(1~99)';
    }
    //name 必填，檢查格式，空白錯誤
    if (!/^[\u4e00-\u9fa5]{2,3}$/.test(nameField.value.trim()) || nameField.value === '') {
      isPass = false;
      nameField.style.border = "2px solid red";
      nameField.nextElementSibling.innerHTML = '請輸入正確的中文名字字數';
    }
    // email 必填，檢查格式，空白錯誤
    if (emailField.value === '' || !validateEmail(emailField.value)) {
      isPass = false;
      emailField.style.border = "2px solid red";
      emailField.nextElementSibling.innerHTML = '請輸入正確的 Email 格式';
    }
    // mobile 必填，檢查格式，空白錯誤
    if (mobileField.value.lenght < 9 || !validateMobile(mobileField.value) || mobileField.value === '' || !/^\d+$/.test(mobileField.value)) {
      isPass = false;
      mobileField.style.border = "2px solid red";
      mobileField.nextElementSibling.innerHTML = '請輸入正確的手機號碼(09........)';
    }
    // nameid 必填，檢查格式，空白錯誤
    if (nameidField.value.lenght < 10 || !validateNameid(nameidField.value) || nameidField.value === '') {
      isPass = false;
      nameidField.style.border = "2px solid red";
      nameidField.nextElementSibling.innerHTML = '請輸入正確的身分證字號(英文必須大寫)';
    }
    // birthday 必填，空白錯誤
    if (birthdayField.value === '') {
      isPass = false;
      birthdayField.style.border = "2px solid red";
      birthdayField.nextElementSibling.innerHTML = '必填項目';
    }
    // address 必填，空白錯誤
    if (addressField.value === '') {
      isPass = false;
      addressField.style.border = "2px solid red";
      addressField.nextElementSibling.innerHTML = '必填項目';
    }

    // 正規化區塊
    //group_id 檢查格式
    function validategroup_id(group_id) {
      const groupid =
        /^(0|[1-9]|[1-9][0-9]?)$/;
      return groupid.test(group_id);
    }
    //nameid 檢查格式
    function validateNameid(nameid) {
      const nameidd = /^[A-Z][1-2]\d{8}$/;
      return nameidd.test(nameid);
    }
    //email 檢查格式
    function validateEmail(email) {
      const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
    //mobile 檢查格式
    function validateMobile(mobile) {
      const pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
      return pattern.test(mobile);
    }

    //如有欄位有通過，才發送AJAX
    if (isPass) {

      const fd = new FormData(document.form1); // 看成沒有外觀的表單-傳至後端
      fetch('group_add_api.php', {
          method: 'POST',
          body: fd
        })
        .then(r => r.json())
        .then(result => {
          console.log(result);
          if (result.success) {
            // alert('資料新增成功')
            successModal.show();
          } else {
            // alert('資料新增失敗')
            if (result.error) {
              failureInfo.innerHTML = result.error;
            } else {
              failureInfo.innerHTML = '資料新增沒有成功';
            }
            failureModal.show();
          }
        })
        .catch(ex => {
          // alert('資料新增發生錯誤' + ex)
          failureInfo.innerHTML = '資料新增發生錯誤' + ex;
          failureModal.show();
        })
    }
  }
  const successModal = new bootstrap.Modal('#successModal');
  const failureModal = new bootstrap.Modal('#failureModal');
  const failureInfo = document.querySelector('#failureModal .alert-danger');
</script>

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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
<?php include __DIR__ . '/../part/html-foot.php'; ?>