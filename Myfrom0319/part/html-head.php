<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <title><?= empty($title) ? '填寫表單的網站' : "$title - 填寫表單的網站" ?></title>
  <link rel="stylesheet" href="./class.css">
  <style>
    @font-face {
      src: url(../font/useFont.ttf) format(opentype);
      font-family: "useFont";
    }

    ul,
    div {
      font-family: "useFont";
    }

    .bs {
      margin-top: 8px;
      margin-left: 40px;
      /* HOME>NOW位置調整 */
    }
    .ba{
    margin-top: 1.5px;
    }
  </style>
</head>

<body>