<?php
require '../parts/form_pdo-connect.php';
session_start();
$isAbled = $_SESSION['permission']['form'] == 'view' ? 'disabled' : '';
if ($_SESSION['permission']['form']=='noAuthority'){
    header('Location: ../index.php');
    exit;
}
$title = "講座管理";
$pageName = 'speechForm';

?>
<?php include '../parts/html-head.php' ?>
<?php include '../parts/spinner.php' ?>
<?php include '../parts/slidebar.php' ?>
<?php include '../parts/navbar.php' ?>

<?php
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;   #轉換成整數
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$perPage = 10;      #每頁幾項

$t_sql = "SELECT COUNT(1) FROM speech_list";     #搜尋筆數
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; #總筆數
$totalPages = ceil($totalRows / $perPage);       #總頁數   
$rows = []; #預設為空陣列

if ($page > $totalPages) {                      #如當前頁數>總頁數
    header('Location: ?page=' . $totalPages);   #就會跳到最前或最後，然後結束
    exit;
}

$sql = sprintf("SELECT * FROM speech_list LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll();
?>

<!-- 轉換成json文字，陣列呈現---註解中 -->
<!-- <div><?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?></div> -->

<!-- 把PHP的JSON轉換成JS的字串 。轉換資料，不是溝通。前後端分開不太適用-->

<!-- 點列表LIST出現的部分 -->
<div class="container-fluid pt-4 px-4" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="bg-secondary rounded h-100 p-4 ">
            <!-- 下方欄位區塊 -->
            <h3 class="pb-3">講座表單一覽</h3>
            <button class="btn btn-outline-primary mb-2" type="button" onclick="window.location.href='speech_add.php';" <?=$isAbled?>>新增</button>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">修改</th>
                        <th class="text-center">編號</th>
                        <th class="text-center">團體行程 I D</th>
                        <th class="text-center">講座時間</th>
                        <th class="text-center">講座地址</th>
                        <th class="text-center">講座聯絡電話</th>
                        <th class="text-center">講師</th>
                        <th class="text-center">參加人數上限</th>
                        <th class="text-center">國家</th>
                        <th class="text-center">介紹</th>
                        <th class="text-center">刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td class="text-center"><a href="speech_edit.php?sid=<?= $r['sid'] ?>" class="<?= $isAbled ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td class="text-center"><?= $r['sid'] ?></td>
                            <td class="text-center"><?= $r['group_id'] ?></td>
                            <td class="text-center"><?= $r['speechtime'] ?></td>
                            <td class="text-center"><?= $r['speechplace'] ?></td>
                            <td class="text-center"><?= $r['speechtell'] ?></td>
                            <td class="text-center"><?= $r['speechname'] ?></td>
                            <td class="text-center"><?= $r['speechpeoplelimit'] ?></td>
                            <td class="text-center"><?= $r['country'] ?></td>

                            <td class="text-center">

                                <button type="button" class="btn btn-outline-warning w-100" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="<?= $r['introduction'] ?>">
                                    <?= $r['country'] ?>
                                </button>
                            </td>

                            <td class="text-center"><a href="speech_delete.php?sid=<?= $r['sid'] ?>" class="<?= $isAbled ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- 頁碼區塊 -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
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
                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) : ?>
                        <?php if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?= $i != $page ?: 'active' ?>">
                                <a class="page-link <?= $i != $page ? 'bg-secondary border-light' : 'active' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endif ?>
                    <?php endfor ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link bg-secondary border-light" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a></li>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link bg-secondary border-light" href="?page=<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a></li>

                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include '../parts/footer.php' ?>
<?php include '../parts/scripts.php' ?>
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
</script>
<?php include '../parts/html-foot.php' ?>