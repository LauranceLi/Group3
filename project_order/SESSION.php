<?php

//查看SESSION內容

session_start();

header('Content-Type: application/json');

echo json_encode($_SESSION);

