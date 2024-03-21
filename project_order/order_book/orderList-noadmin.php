<!-- 用引用檔案的方式連線資料庫 -->
<?php require __DIR__ . '/parts/pdo-connect.php';
$title = '訂單列表';
$pageName = 'list';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//頁碼小於1 就跳轉到第一頁 
if ($page < 1) {
    header('Location: ?page=1');
    exit();
}

//決定每一頁有幾筆資料
$perPage = 20;

// 計算總筆數
$t_sql = "SELECT COUNT(1) FROM `order`";
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$totalPage = ceil($totalRows / $perPage);  //總筆數頁數(無條件進位)

//限制跳轉頁數不超過最大頁數
$rows = []; //預設值為空陣列
if ($totalRows > 0) {
    //有資料才往下執行
    if ($page > $totalPage) {
        header('Location:?page=' . $totalPage);
        exit();
    }
    //取得分頁資料
    $sql = sprintf("SELECT * FROM `order` LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
    // (SELECT)讀取SQL的資料的時候才需要fetchAll() 或fetch() 
}


?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<div class="container">
    <!-- <div><?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?></div>  --><!-- 顯示在頁面 -->

    <!-- 顯示總筆數頁數 -->
    <div class="row">
        <div class="col"></div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- 插入箭頭fontawesome的icon  (head.html要記得插入fontawesome的CDN) 左邊 -->
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a></li>
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-chevron-left"></i></a></li>
                <!-- 保留當前頁碼前後各兩個(數量可以隨喜好調整) -->
                <?php for ($i = $page - 2; $i <= $page + 2; $i++) : ?>
                    <!-- 條件判斷 讓顯示範圍不超過0~最大頁數之間 -->
                    <?php if ($i >= 1 and $i <= $totalPage) : ?>
                        <!-- 加上三元運算子 反藍當前頁碼 -->
                        <li class="page-item <?= $i == $page ? "active" : '' ?>">
                            <!-- <li class="page-item <?= $i != $page ?: "active" ?>"> 這樣寫也可以-->
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif ?>
                <?php endfor ?>
                <!-- 插入箭頭fontawesome的icon  右邊 -->
                <li class="page-item <?= $page == $totalPage ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-chevron-right"></i></a></li>
                <li class="page-item <?= $page == $totalPage ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $totalPage ?>"><i class="fa-solid fa-angles-right"></i></a></li>
            </ul>
        </nav>
    </div>

    <!-- 總筆數的欄位 -->
    <div class="row">
        <div class="col"><?= $totalRows ?></div>
    </div>
    <!-- 把資料庫的資料拉出來做成表格 -->
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>order_id</th>
                        <th>customer_id</th>
                        <th>purchaser_name</th>
                        <th>payment_method</th>
                        <th>shipping_method</th>
                        <th>order_date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><?= $r['order_id'] ?></td>
                            <td><?= $r['customer_id'] ?></td>
                            <td><?= $r['purchaser_name'] ?></td>
                            <td><?= $r['payment_method'] ?></td>
                            <td><?= $r['shipping_method'] ?></td>
                            <td><?= $r['order_date'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>