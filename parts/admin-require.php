<?php
if (!isset($_SESSION)){
  session_start();
}


                  # 身分類別
if (!isset($_SESSION["admin"])){
  header('Location: index_.php');
  exit;
}
