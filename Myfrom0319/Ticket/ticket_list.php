<?php include __DIR__ . '/part/html-head.php';
require __DIR__ . '/ticket_pdo-connect.php';  #附上資料庫連結
?>


<?php
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;   #轉換成整數

$perPage = 5;      #每頁幾項

$t_sql = "SELECT COUNT(1) FROM ticket";     #搜尋筆數
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; #總筆數
$totalPages = ceil($totalRows / $perPage);       #總頁數   

$sql = sprintf ("SELECT * FROM ticket LIMIT %s, %s", ($page-1)*$perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll();
?>

<!-- 轉換成json文字，陣列呈現---註解中 -->
<!-- <div><?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?></div> -->

<!-- 把PHP的JSON轉換成JS的字串 。轉換資料，不是溝通。前後端分開不太適用-->
<script>
    const myRows = <?= $totalRows ?>;
</script>



<!-- 點列表LIST出現的部分 -->
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <!-- <span>總頁數<?= $totalPages ?></span> -->
        <span>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                    <?php for($i=1; $i<=$totalPages; $i++): ?>
                    
                    <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    
                    <?php endfor ?>
                    </li>
                </ul>
            </nav>
        </span>
        <table class="table table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th>姓名</th>
                    <th>電話</th>
                    <th>信箱</th>
                    <th>想了解的行程、國家、地點</th>
                    <th>聯絡時間</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['tell'] ?></td>
                        <td><?= $r['email'] ?></td>
                        <td><?= $r['contact'] ?></td>
                        <td><?= $r['calltime'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>



    </div>

    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
</div>
<?php require __DIR__ . '/../part/html-foot.php';?>