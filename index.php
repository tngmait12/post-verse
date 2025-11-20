<?php
  include('includes/config.php');
  include('config.php');

  $page_title = "Home Page";
  $meta_description = "This is home page of PHP Blog Website";
  $meta_keyword = "PHP, Blog, Website, HTML, CSS, JS, BOOTSTRAP";


  include('includes/header.php');
?>

<?php include('includes/section-featured.php'); ?>

<section class="blog">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="blog-section-title">
          <h2>Articles</h2>
          <p>View the latest news on Blogger</p>
        </div>
        <?php include('section/blog-post.php') ?>
      </div>
      
      <?php include('includes/trending-post.php') ?>

    </div>
  </div>
</section>

<?php
include('includes/footer.php');
?>