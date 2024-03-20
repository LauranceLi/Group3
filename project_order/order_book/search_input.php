<?php require __DIR__ . '/parts/pdo-connect.php';
?>
<?php include __DIR__ . '/parts/html-head.php' ?>

<div class="row d-inline-flex">
    <div class="col-auto">
        <form action="search_output.php" method="post">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="搜尋關鍵字" id="input">
                <div class="input-group-append">
                    <input type="submit" value="搜尋" class=" btn btn-outline-secondary " id="submit">
                </div>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php' ?>

<?php include __DIR__ . '/parts/html-foot.php' ?>