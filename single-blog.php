<?php 
  $slug = $_GET["slug"] ?? '';

  include('includes/config.php');

  $stmt = mysqli_prepare($con,'SELECT p.*, u.fname, u.lname FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE slug = ?');
  mysqli_stmt_bind_param($stmt,'s', $slug);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $post_result = mysqli_fetch_assoc($result);

  include('includes/header.php');
?>

<body>
<section class="blog-single">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 order-2 order-lg-2">
        <div class="comments h-100 border p-2" style="border-color: black; border-radius: 20px; border-width: 20px;">
          <h3 class="text-center border-bottom">Comments</h3>
          <div class="">
            sfshfjhdfjk
          </div>
        </div>
      </div>
      <div class="col-lg-8 order-1 order-lg-1">
        <article class="single-blog">
          <a href="#" class="tag">Travel</a>
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
          </ul>
          <!-- <img src="images/featured-post.jpg"alt="banner"> -->
          <img src="uploads/posts/<?= $post_result['image'] ?>" width="100%" alt="banner">
          
          <div style="display: block;"><?= $post_result['description'] ?></div>
        </article>
        
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php') ?>