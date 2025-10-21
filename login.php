<?php
session_start();
include('includes/config.php');

$page_title = "Login Page";
$meta_description = "This is Login page of PHP Blog Website";
$meta_keyword = "PHP, Blog, Website, HTML, CSS, JS, BOOTSTRAP";

include('includes/header.php'); 

if (isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already logged in";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit(0);
}
$_SESSION['login-referer'] = $_SERVER['HTTP_REFERER'];
?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php include('message.php'); ?>
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white text-center">
            <h4>User Login</h4>
          </div>
          <div class="card-body">
            <form action="logincode.php" method="POST">
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
              </div>
              <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
              </div>
              <button type="submit" name="login_btn" class="btn btn-primary btn-block mt-4">Login</button>
            </form>
          </div>
          <div class="card-footer text-center">
            <small>Don't have an account? <a href="register.php">Register here</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>
