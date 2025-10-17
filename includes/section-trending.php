<div class="blog-post-widget">
  <div class="latest-widget-title">
    <h2>Trending Posts</h2>
  </div>

  <?php
  // Lấy 5 bài có lượt xem cao nhất
  $trend_query = "SELECT * FROM posts WHERE status='0' ORDER BY views DESC LIMIT 5";
  $trend_run = mysqli_query($con, $trend_query);

  if ($trend_run && mysqli_num_rows($trend_run) > 0) {
    while ($trend = mysqli_fetch_assoc($trend_run)) {
  ?>
      <div class="latest-widget mb-3">
        <div class="latest-widget-thum">
          <a href="single-blog.php?slug=<?= urlencode($trend['slug']) ?>">

            <img src="uploads/posts/<?= htmlspecialchars($trend['image']) ?>" alt="<?= htmlspecialchars($trend['name']) ?>" />
          </a>
          <div class="icon">
            <a href="single-blog.php?slug=<?= urlencode($trend['slug']) ?>">

              <img src="images/blog/icon.svg" alt="icon" />
            </a>
          </div>
        </div>
        <div class="latest-widget-content">
          <div class="content-title">
           <a href="single-blog.php?slug=<?= urlencode($trend['slug']) ?>">

              <?= htmlspecialchars($trend['name']) ?>
            </a>
          </div>
          <div class="content-meta">
            <ul>
              <li>
                <i class="fa fa-clock-o"></i>
                <?= date('F j, Y', strtotime($trend['created_at'])) ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
  <?php
    }
  } else {
    echo "<p>No trending posts available.</p>";
  }
  ?>
</div>
