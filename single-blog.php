<?php 
  $slug = $_GET["slug"] ?? '';

  include 'admin/config/dbcon.php';

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
      <div class="col-lg-2 order-2 order-lg-1">
        <div class="share-now">
          <a href="#" class="scrol">Share</a>
          <div class="sociel-icon">
            <ul>
              <li> <a href="#"><i class="fa fa-facebook"></i></a></li>
              <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
              <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-10 order-1 order-lg-2">
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

          <!-- <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
            et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet
            clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.
            <br>
            <br>

            consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea
            takimata sanctus est Lorem ipsum dolor sit amet. <br> <br>

            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
            dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
            clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.
            <br>
            <br>

            consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
            sea takimata sanctus est Lorem ipsum dolor sit amet.
          </p>
          <h3>Make better business</h3>
          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
            et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet
            clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.
            <br> <br>

            consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea
            takimata sanctus est Lorem ipsum dolor sit amet.
          </p>
          <blockquote>
            <p>"You’ve got to get up every morning with determination if you’re going to go to bed with satisfaction."
            </p>
          </blockquote>
          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
            et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet
            clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.
            <br> <br>
            consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea
            takimata sanctus est Lorem ipsum dolor sit amet.
          </p>
          <div class="single-blog-banner">
            <div class="banner"> <img src="images/blog/single-blog.png" alt="banner">
            </div>
            <div class="banner"> <img src="images/blog/single-blog-2.png" alt="banner">
            </div>
          </div>
          <h3>The Dreamy Factors</h3>
          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
            et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet
            clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.
            <br> <br>
            consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea
            takimata sanctus est Lorem ipsum dolor sit amet.
          </p> -->
          <div style="display: block;"><?= $post_result['description'] ?></div>
        </article>
        
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php') ?>