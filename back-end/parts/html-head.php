<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
    <meta charset="utf-8">
    <title><?= empty($title) ? '第三小组專题' : "$title - 第三小组專题" ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <style>
        .sidebar {
            overflow: hidden;
        }

        .noAuthority {
            background-color: black !important;
            pointer-events: none !important;
            border: 0;
            opacity: 0.3 !important;
            user-select: none;
        }

        a.noAuthority:hover,
        a.disabled:hover {

            cursor: not-allowed;
            /* 禁止鼠标点击事件 */
        }

        .disabled {
            pointer-events: none !important;
            opacity: 0.3 !important;
            user-select: none;
        }

        /* #shipping_date {
            color: red;
        } */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>