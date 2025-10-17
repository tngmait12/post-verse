<?php
include('includes/config.php');

$page_title = "Home Page";
$meta_description = "This is home page of PHP Blog Website";
$meta_keyword = "PHP, Blog, Website, HTML, CSS, JS, BOOTSTRAP";

include('includes/header.php');
?>

<!-- Featured Section -->
<?php include('includes/section-featured.php'); ?>

<!-- Blog Section -->
<section class="blog">
  <div class="container">
    <div class="row">
      <!-- ==== LEFT COLUMN: ARTICLES ==== -->
      <div class="col-lg-8">
        <div class="blog-section-title">
          <h2>Articles</h2>
          <p>View the latest news on Blogger</p>
        </div>
        <?php include('includes/blog-post.php'); ?>
      </div>

      <!-- ==== RIGHT COLUMN: TRENDING ==== -->
      <div class="col-lg-4">
        <?php include('includes/section-trending.php'); ?>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>
