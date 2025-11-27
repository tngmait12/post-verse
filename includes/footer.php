<?php
if (isset($con)) {

  $navbar_categories_query = "SELECT name, slug FROM categories WHERE navbar_status='1' AND status='1' LIMIT 4";
  $navbar_categories_result = mysqli_query($con, $navbar_categories_query);
} else {

  $navbar_categories_result = false;
}
?>
<section class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 mx-auto text-center">
        <div class="footer-logo">
          <a href="index.php" style="text-decoration: none; color: inherit;">
            <h4 style="margin: 0; font-weight: bold; letter-spacing: 1px;">
              POST VERSE
            </h4>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 mx-auto">
        <div class="footer-nav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home </a>
            </li>
            <?php
            if ($navbar_categories_result && mysqli_num_rows($navbar_categories_result) > 0) {
              foreach ($navbar_categories_result as $item) {
            ?>
                <li class="nav-item">
                  <a class="nav-link" href="category.php?slug=<?= $item['slug']; ?>"><?= $item['name']; ?></a>
                </li>
            <?php
              }
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="copy-right">
          <p>
            © Bản quyền <span id="copyrightYear"></span> - POST VERSE - Phát triển bởi Nhóm 3 - Project Phát triển Mã Nguồn mở
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/script.php'); ?>