<?php 
  $slug = $_GET["slug"] ?? '';

  include('includes/config.php');

  $stmt = mysqli_prepare($con,'SELECT p.*, u.fname, u.lname FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE slug = ?');
  mysqli_stmt_bind_param($stmt,'s', $slug);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $post_result = mysqli_fetch_assoc($result);

  include('includes/header.php');
  
  header("single-blog.php?slug=" . urldecode($slug));
?>

<body>
<section class="blog-single">
  <div class="container sticky">
    <div class="row">
      <div class="col-lg-5 order-2 order-lg-2">
        <div id="comments-section" class="border p-2 d-flex flex-column" style="border-color: black; border-radius: 20px; border-width: 20px;">
          <?php include "section/comment.php" ?>
        </div>
      </div>
      <div class="col-lg-7 order-1 order-lg-1">
        <article class="single-blog">
          <!-- <a href="#" class="tag">Travel</a> -->
          <p class="title"><?= $post_result['name'] ?></p>
          <ul class="meta">
            <li>By <a href="about.html"><?= $post_result['lname'] . ' ' . $post_result['fname'] ?></a></li>
            <li>
              <i class="fa fa-clock-o"></i>
              <?php 
                  $created_at = strtotime($post_result['created_at']); 
                  echo date('F j, Y, H:i', $created_at);
              ?>
            </li>
            <li class="flex-fill d-flex justify-content-end align-items-top">
                <a class=" text-primary">
                  <p class="d-inline ml-2">12</p> <i class=" bi bi-hand-thumbs-up-fill"></i>
                </a>
                <a class=" text-danger">
                  <p class="d-inline ml-2">12</p> <i class="bi bi-hand-thumbs-down-fill"></i>
                </a>
              </li>
          </ul>
          <img src="uploads/posts/<?= $post_result['image'] ?>" width="100%" alt="banner">
          
          <div style="display: block;"><?= $post_result['description'] ?></div>
        </article>
        
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php') ?>