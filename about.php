<?php
include('includes/config.php');

$page_title = "About Us";
$meta_description = "Learn more about our blog and team";
$meta_keyword = "about, blog, team, php project";

include('includes/header.php');
?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h2 class="mb-4 text-center">About Our Blog</h2>
            <p>
              Welcome to <strong>MyBlog</strong> — a simple PHP-based blogging platform created as a student project.
              Our goal is to build a space where you can share thoughts, ideas, and experiences through articles and discussions.
            </p>
            <p>
              This project demonstrates how to use <b>PHP, MySQL, HTML, CSS, and Bootstrap</b> to create a complete web application.
              Each member of our team has contributed to different modules like authentication, article management, and user interface.
            </p>
            <p>
              We hope this blog helps readers explore and learn more about modern web development.  
              Thank you for visiting!
            </p>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>
