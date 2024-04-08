<?php

//切換頁面
session_start();
if(isset($_SESSION['admin'])){
    //有登入
    include __DIR__.'/orderList-admin.php';
}else{
    //沒有登入
    include __DIR__.'/orderList-noadmin.php';
}