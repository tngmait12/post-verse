<?php 
if (isset($con)) {
    
    $navbar_categories_query = "SELECT name, slug FROM categories WHERE navbar_status='0' AND status='0' LIMIT 4";
    $navbar_categories_result = mysqli_query($con, $navbar_categories_query);
} else {
    
    $navbar_categories_result = false;
}

?>

<nav class="main-nav navbar navbar-expand-lg">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
      <h2>POST VERSE</h2>
    </a>
    <!-- Toogle Button -->
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#mainNav">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse nav-list" id="mainNav">
      <!-- Navigation Links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home </a>
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
        <!-- Authentication Links -->
        <?php if (isset($_SESSION['auth'])) : ?>
          <div class="dropdown show">
            <li class="nav-item">
              <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Account
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?= $base_url ?>/admin/index.php">Admin Page</a>
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </div>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        <?php endif; ?>
        <!-- End Authentication Links -->
      </ul>
      <!-- Social Link -->
      <ul class="main-nav-social">
        <li>
          <a href="#"><i class="fa fa-facebook"></i></a>
        </li>
        <li>
          <a href="#"><i class="fa fa-twitter"></i></a>
        </li>
        <li>
          <a href="#"><i class="fa fa-instagram"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php include('message.php'); ?>