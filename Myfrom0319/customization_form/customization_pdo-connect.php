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

$sql= "SELECT * FROM proj57.customization_list;";
$stmt=$pdo->query($sql);

$rows=$stmt->fetchAll();

// header('Content-Type: application/json');
//告訴瀏覽器回應的是json

// echo json_encode($rows);