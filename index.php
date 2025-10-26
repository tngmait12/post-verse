<?php

include('includes/config.php');

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
      <div class="col-lg-4">
        <div class="blog-post-widget">
          <div class="latest-widget-title">
            <h2>Trending post</h2>
          </div>
          <div class="latest-widget">
            <div class="latest-widget-thum">
              <a href="single-blog.html">
                <img src="images/blog/blog-thum-8.png" alt="blog-thum" /></a>
              <div class="icon">
                <a href="single-blog.html">
                  <img src="images/blog/icon.svg" alt="icon" /></a>
              </div>
            </div>
            <div class="latest-widget-content">
              <div class="content-title">
                <a href="single-blog.html">Five Things You Need to Know to Start Your Day</a>
              </div>
              <div class="content-meta">
                <ul>
                  <li>
                    <i class="fa fa-clock-o"></i>
                    October 19, 2020 - 2 min
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="latest-widget">
            <div class="latest-widget-thum">
              <a href="single-blog.html">
                <img src="images/blog/blog-thum-9.png" alt="blog-thum" /></a>
              <div class="icon">
                <a href="single-blog.html">
                  <img src="images/blog/icon.svg" alt="icon" /></a>
              </div>
            </div>
            <div class="latest-widget-content">
              <div class="content-title">
                <a href="single-blog.html">Five Things You Need to Know to Start Your Day</a>
              </div>
              <div class="content-meta">
                <ul>
                  <li>
                    <i class="fa fa-clock-o"></i>
                    October 19, 2020 - 2 min
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="latest-widget">
            <div class="latest-widget-thum">
              <a href="single-blog.html">
                <img src="images/blog/blog-thum-10.png" alt="blog-thum" /></a>
              <div class="icon">
                <a href="single-blog.html">
                  <img src="images/blog/icon.svg" alt="icon" /></a>
              </div>
            </div>
            <div class="latest-widget-content">
              <div class="content-title">
                <a href="single-blog.html">Five Things You Need to Know to Start Your Day</a>
              </div>
              <div class="content-meta">
                <ul>
                  <li>
                    <i class="fa fa-clock-o"></i>
                    October 19, 2020 - 2 min
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="latest-widget">
            <div class="latest-widget-thum">
              <a href="single-blog.html">
                <img src="images/blog/blog-thum-11.png" alt="blog-thum" /></a>
              <div class="icon">
                <a href="single-blog.html">
                  <img src="images/blog/icon.svg" alt="icon" /></a>
              </div>
            </div>
            <div class="latest-widget-content">
              <div class="content-title">
                <a href="single-blog.html">Five Things You Need to Know to Start Your Day</a>
              </div>
              <div class="content-meta">
                <ul>
                  <li>
                    <i class="fa fa-clock-o"></i>
                    October 19, 2020 - 2 min
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include('includes/footer.php');
?>