<!-- 用引用檔案的方式連線資料庫 -->
<?php require __DIR__ . '/parts/pdo-connect.php';session_start();
$isAbled = $_SESSION['permission']['orders'] == 'view' ? 'disabled' : '';
if ($_SESSION['permission']['orders']=='noAuthority'){
    header('Location: ../noAuthority.php');
    exit;
}

$title = '訂單列表';
$pageName = 'orderList';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit();
}
$perPage = 10;
$t_sql = "SELECT COUNT(1) FROM `order`";
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$totalPage = ceil($totalRows / $perPage);
$rows = [];
if ($totalRows > 0) {
    if ($page > $totalPage) {
        header('Location:?page=' . $totalPage);
        exit();
    }
    $sql = sprintf("SELECT * FROM `order` LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}
$sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : ''; // 排序欄位
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // 排序順序，默認為升序
function compare($a, $b)
{
    global $sort_column, $sort_order;
    switch ($sort_column) {
        case 'transaction_id':
            $comparison_result = $sort_order === 'ASC' ? $a['transaction_id'] - $b['transaction_id'] : $b['transaction_id'] - $a['transaction_id'];
            break;
        case 'total_amount':
            $comparison_result = $sort_order === 'ASC' ? $a['total_amount'] - $b['total_amount'] : $b['total_amount'] - $a['total_amount'];
            break;
        case 'order_date':
        case 'shipping_date':
            $comparison_result = $sort_order === 'ASC' ? strtotime($a[$sort_column]) - strtotime($b[$sort_column]) : strtotime($b[$sort_column]) - strtotime($a[$sort_column]);
            break;
        default:
            $comparison_result = $sort_order === 'ASC' ? $a['order_id'] - $b['order_id'] : $b['order_id'] - $a['order_id'];
            break;
    }
    return $comparison_result;
}
if ($sort_column !== '') {
    usort($rows, 'compare');
}
?>
<?php include '../parts/html-head.php' ?>
<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>

<div class="m-4">
    <div class="bg-secondary rounded h-100 p-4 w-100">
    <h3 class="pb-3">訂單列表</h3>

        <div class="row g-4">
            <div class="col mt-3 mb-1 d-flex justify-content-between">
                <?php include __DIR__ . '/filter.php'; ?>
                <?php include __DIR__ . '/search_input.php'; ?>
            </div>

        </div>


        <div class="row d-flex">
            <div class="col">
            <button class="btn btn-outline-primary mb-2" type="button" onclick="window.location.href='add.php';" <?= $isAbled ?>>新增</button>
                <table class="table table-bordered table-striped w-100">
                    <thead>
                        <tr>
                            <th>訂單狀態<a href="?page=<?= $page ?>&sort_column=order_status&sort_order=<?= $sort_column === 'order_status' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>交易編號<a href="?page=<?= $page ?>&sort_column=transaction_id&sort_order=<?= $sort_column === 'transaction_id' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>訂購人姓名<a href="?page=<?= $page ?>&sort_column=purchaser_name&sort_order=<?= $sort_column === 'purchaser_name' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>總金額<a href="?page=<?= $page ?>&sort_column=total_amount&sort_order=<?= $sort_column === 'total_amount' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>付費方式<a href="?page=<?= $page ?>&sort_column=payment_method&sort_order=<?= $sort_column === 'payment_method' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>付費狀態<a href="?page=<?= $page ?>&sort_column=payment_status&sort_order=<?= $sort_column === 'payment_status' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>送貨方式<a href="?page=<?= $page ?>&sort_column=shipping_method&sort_order=<?= $sort_column === 'shipping_method' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>送貨狀態<a href="?page=<?= $page ?>&sort_column=shipping_status&sort_order=<?= $sort_column === 'shipping_status' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>送貨地址<a href="?page=<?= $page ?>&sort_column=shipping_address&sort_order=<?= $sort_column === 'shipping_address' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>送貨日期<a href="?page=<?= $page ?>&sort_column=shipping_date&sort_order=<?= $sort_column === 'shipping_date' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th>下單日期<a href="?page=<?= $page ?>&sort_column=order_date&sort_order=<?= $sort_column === 'order_date' && $sort_order === 'ASC' ? 'DESC' : 'ASC' ?>"><i class="fa-solid fa-sort"></i></a></th>
                            <th><i class="fa-solid fa-pen-to-square"></i></th>
                            <th><i class="fa-solid fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr>
                                <td><?= $r['order_status'] ?></td>
                                <td><a href="order_detail.php?transaction_id=<?= htmlentities($r['transaction_id']) ?>"><?= htmlentities($r['transaction_id']) ?></td>
                                <td><?= $r['purchaser_name'] ?></td>
                                <td><?= $r['total_amount'] ?></td>
                                <td><?= $r['payment_method'] ?></td>
                                <td><?= $r['payment_status'] ?></td>
                                <td><?= $r['shipping_method'] ?></td>
                                <td><?= $r['shipping_status'] ?></td>
                                <td><?= $r['shipping_address'] ?></td>
                                <td><?= $r['shipping_date'] ?></td>
                                <td><?= $r['order_date'] ?></td>
                                <td><a href="edit.php?order_id=<?= $r['order_id'] ?>" class="<?= $isAbled ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="javascript:deleteOne(<?= $r['order_id'] ?>)" class="<?= $isAbled ?>"><i class="fa-solid fa-trash  text-danger"></i></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>


            <nav aria-label="First group">
                <div class="col"><span>總筆數 : </span><?= $totalRows ?></div>
                <ul class="pagination justify-content-center ">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                        <a class="page-link bg-secondary border-light" href="?page=<?= 1 ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link bg-secondary border-light" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                    <!-- 限制頁碼條 -->
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
                        <?php if ($i >= 1 and $i <= $totalPage) : ?>
                            <li class="page-item <?= $i != $page ?: 'active' ?>">
                                <a class="page-link <?= $i != $page ? 'bg-secondary border-light' : 'active' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endif ?>
                    <?php endfor ?>
                    <li class="page-item <?= $page == $totalPage ? 'disabled' : '' ?>">
                        <a class="page-link bg-secondary border-light" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == $totalPage ? 'disabled' : '' ?>">
                        <a class="page-link bg-secondary border-light" href="?page=<?= $totalPage ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>



        </div>
    </div>
</div>
<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<script>
    const myRows = <?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?>;

    function deleteOne(order_id) {
        if (confirm(`是否要刪除編號${order_id}的項目？`)) {
            location.href = `delete.php?order_id=${order_id}`;
        }
    }
</script>
<?php include '../parts/html-foot.php' ?>