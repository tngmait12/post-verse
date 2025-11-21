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


    <!-- Search -->
    <form class="d-flex align-items-center ml-3" method="GET" action="search_advanced.php" style="gap: 8px;">
    
    <input class="form-control"
           type="search"
           name="q"
           placeholder="Search..."
           aria-label="Search"
           required
           style="height: 35px; width: 150px;">
    
    <button class=" d-flex align-items-center justify-content-center"
        type="submit"
        style="height: 35px; width: 45px; padding: 0;">
    <i class="fa fa-search"></i>
</button>

</form>
      
      <!-- Navigation Links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
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
