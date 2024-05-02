<?php
//設定資料庫連線  
$db_host = "localhost";  //localhost可以改成其他IP就可以連到其他電腦的資料庫
$db_user = 'the_travel_project';      //資料庫的使用者名稱
$db_pass =  '';       //資料庫的密碼
$db_name = 'the_travel_project'; //要連線的資料庫

//data source name 字串中間不能有空白   如果不是使用3306的PORT 後面就要多寫PORT=連線埠號碼
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

//設定pdo 選項
$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //設定錯誤訊息的顯示方式
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    //設定印出的資料形式(索引/關聯 陣列)
];


$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options); //這邊也要記得寫變數$pdo_options才會有設定
//有連上就會看到空白頁面

//初始化判定
if(! isset($_SESSION)){
    session_start();  //只能有一個 一個以上會出錯
}
