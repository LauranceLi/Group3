<?php
  require __DIR__ . '/parts/pdo_connect.php';
  session_start();
  $title = "登入";
  $pageName = 'index';
  
?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/spinner.php' ?>

<!-- Sign In Start -->
<div class="container-fluid">
  <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
      <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <a href="index.html" class="">
            <h3 class="text-primary"><i class="fa-solid fa-tree me-2"></i>締杉旅遊</h3>
          </a>
          <h3>Sign In</h3>
        </div>
        <form name="signInForm" method="POST" action="signIn.php">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-4">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="">Forgot Password</a>
          </div>
          <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Sign In End -->




<?php include __DIR__ . '/parts/scripts.php' ?>
<?php include __DIR__ . '/parts/html-foot.php' ?>