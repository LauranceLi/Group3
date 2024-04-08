<?php  
include './parts/pdo_connect.php';

session_start();
unset($_SESSION["admin"]);

header("Location: index.php");