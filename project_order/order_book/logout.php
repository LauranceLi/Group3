<?php

session_start();
// 登出時移除使用者的SESSION
unset($_SESSION['admin']);
//跳轉到20240126-06-login.php的頁面
header('Location:index_.php');

