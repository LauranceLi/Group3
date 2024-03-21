<?php

$db_host='localhost';
$db_user='root';
$db_pass='';
$db_name='proj57';

$dsn="mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options =[
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo=new PDO($dsn,$db_user,$db_pass);


//看情況19，22要註解調
header('Content-Type: application/json');
//告訴瀏覽器回應的是json

echo json_encode($rows);