      <!-- 頁碼區塊 -->
      <?php 
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;   #轉換成整數
      if ($page < 1) {
        header('Location: ?page=1');
        exit;
      }
      
      # 每一頁有幾筆
      $per_page = 10;
      
      # 計算總筆數
      $pages_sql = "SELECT COUNT(1) FROM role_set";
      $pages_result = $conn->query($pages_sql)->fetch_assoc();
      $total_rows = $pages_result['COUNT(1)'];
      
      
      $total_pages = ceil($total_rows / $per_page); # 總頁數
      $per_page_row = [];
      if ($total_rows > 0) {
        if ($page > $total_pages) {
          header('Location: ?page=' . $total_pages);
          exit;
        }
      }?>
      <nav aria-label="First group">
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
            <?php if ($i >= 1 and $i <= $total_pages) : ?>
              <li class="page-item <?= $i != $page ?: 'active' ?>">
                <a class="page-link <?= $i != $page ? 'bg-secondary border-light' : 'active' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endif ?>
          <?php endfor ?>
          <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
            <a class="page-link bg-secondary border-light" href="?page=<?= $page + 1 ?>">
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </li>
          <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
            <a class="page-link bg-secondary border-light" href="?page=<?= $total_pages ?>">
              <i class="fa-solid fa-angles-right"></i>
            </a>
          </li>
        </ul>
      </nav>