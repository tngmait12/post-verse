<?php
// includes/section-featured.php (3 item)
if (!isset($con)) {
    include('includes/config.php');
}
?>

<section class="featured py-5">
  <div class="container">
    <div class="section-title mb-4">
      <h2>Featured Posts</h2>
    </div>
    <div class="row">
      <?php
      $featured_query = "SELECT p.*, u.fname, u.lname 
                         FROM posts p
                         LEFT JOIN users u ON p.user_id = u.id
                         WHERE p.status = 0
                         ORDER BY p.created_at DESC
                         LIMIT 3";
      $featured_run = mysqli_query($con, $featured_query);
      if (!$featured_run) {
        die("SQL error: " . mysqli_error($con));
      }

      if (mysqli_num_rows($featured_run) > 0) {
        while ($row = mysqli_fetch_assoc($featured_run)) {
          $img = $row['image'] ?? '';
          if ($img !== '') {
            if (strpos($img, 'uploads/') === 0) {
              $img_path = $img;
            } elseif (file_exists(__DIR__ . '/../uploads/posts/' . $img)) {
              $img_path = 'uploads/posts/' . $img;
            } elseif (file_exists(__DIR__ . '/../uploads/post/' . $img)) {
              $img_path = 'uploads/post/' . $img;
            } else {
              $img_path = 'uploads/' . $img;
            }
          } else {
            $img_path = 'images/placeholder.png';
          }
      ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
              <a href="single-blog.php?slug=<?= urlencode($row['slug']) ?>">
                <img src="<?= htmlspecialchars($img_path) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" style="height:180px; object-fit:cover;" />
              </a>
              <div class="card-body">
                <h5 class="card-title">
                  <a href="single-blog.php?slug=<?= urlencode($row['slug']) ?>"><?= htmlspecialchars($row['name']) ?></a>
                </h5>
                <p class="card-text"><?= substr(strip_tags($row['description']), 0, 100) ?>...</p>
                <p class="text-muted small"><?= date('F j, Y', strtotime($row['created_at'])) ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p class='text-center'>No featured posts available.</p>";
      }
      ?>
    </div>
  </div>
</section>

