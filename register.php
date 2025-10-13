<?php

include('includes/config.php');

$page_title = "Register Page";
$meta_description = "This is Regiter page of PHP Blog Website";
$meta_keyword = "PHP, Blog, Website, HTML, CSS, JS, BOOTSTRAP";

include('includes/header.php'); 

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}
?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php include('message.php'); ?>
        <div class="card shadow-sm">
          <div class="card-header bg-success text-white text-center">
            <h4>User Registration</h4>
          </div>
          <div class="card-body">
            <form action="registercode.php" method="POST">
              <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" value="<?php if(isset($_SESSION['fname'])) echo $_SESSION['fname']; ?>" class="form-control" required placeholder="Enter your first name">
              </div>
              <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" value="<?php if(isset($_SESSION['lname'])) echo $_SESSION['lname']; ?>" class="form-control" required placeholder="Enter your last name">
              </div>
              <div class="form-group mt-3">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>"  class="form-control" required placeholder="Enter your email">
              </div>
              <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
              </div>
              <div class="form-group mt-3">
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" class="form-control" required placeholder="Confirm your password">
              </div>
              <button type="submit" name="register_btn" class="btn btn-success btn-block mt-4">Register</button>
            </form>
          </div>
          <div class="card-footer text-center">
            <small>Already have an account? <a href="login.php">Login here</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>
