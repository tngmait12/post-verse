<section class="featured py-5">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <?php
        include('includes/config.php');

        $featured_query = "SELECT * FROM posts WHERE status='0' AND featured='1' ORDER BY created_at DESC LIMIT 1";
        $featured_run = mysqli_query($con, $featured_query);

        if (!$featured_run) {
          die("SQL error: " . mysqli_error($con)); // Debug lỗi SQL nếu có
        }

        if (mysqli_num_rows($featured_run) > 0) {
          $featured = mysqli_fetch_assoc($featured_run);
        ?>
          <article class="featured-post">
            <div class="featured-post-content">
              <div class="featured-post-author">
                <img src="images/author.png" alt="author" />
                <p>By 
                  <span>
                    <?php
                    $user_id = $featured['user_id'];
                    $user_query = mysqli_query($con, "SELECT fname, lname FROM users WHERE id='$user_id' LIMIT 1");
                    if ($user_query && mysqli_num_rows($user_query) > 0) {
                      $user = mysqli_fetch_assoc($user_query);
                      echo htmlspecialchars($user['fname'] . ' ' . $user['lname']);
                    } else {
                      echo "Admin";
                    }
                    ?>
                  </span>
                </p>
              </div>
              <a href="post.php?title=<?= urlencode($featured['slug']) ?>" class="featured-post-title">
                <?= htmlspecialchars($featured['name']) ?>
              </a>
              <ul class="featured-post-meta">
                <li>
                  <i class="fa fa-clock-o"></i>
                  <?= date('F j, Y', strtotime($featured['created_at'])) ?>
                </li>
              </ul>
              <p><?= substr(strip_tags($featured['description']), 0, 120) ?>...</p>
            </div>
            <div class="featured-post-thumb">
              <img src="uploads/<?= htmlspecialchars($featured['image']) ?>" alt="<?= htmlspecialchars($featured['name']) ?>" />
            </div>
          </article>
        <?php
        } else {
          echo "<p class='text-center'>No featured post available.</p>";
        }
        ?>

      </div>
    </div>
  </div>
</section>
