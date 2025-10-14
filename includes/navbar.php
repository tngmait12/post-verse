<nav class="main-nav navbar navbar-expand-lg">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
      <img class="logo-main" src="images/logo.svg" alt="logo" />
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
        <li class="nav-item">
          <a class="nav-link" href="about.php">About </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <!-- Authentication Links -->
        <?php if (isset($_SESSION['auth'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
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