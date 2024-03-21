<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
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
  </style>
</head>

<body>