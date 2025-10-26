<?php
if (!isset($con)) {
  include('includes/config.php');
}
?>

<section class="featured py-5">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <?php
        // Lấy 1 bài viết mới nhất có status = 0
        $featured_query = "
          SELECT p.*, u.fname, u.lname 
          FROM posts AS p
          LEFT JOIN users AS u ON p.user_id = u.id
          WHERE p.status = 0
          ORDER BY p.created_at DESC
          LIMIT 1
        ";

        $featured_run = mysqli_query($con, $featured_query);

        if (!$featured_run) {
          die("SQL error: " . mysqli_error($con));
        }

        if (mysqli_num_rows($featured_run) > 0) {
          $featured = mysqli_fetch_assoc($featured_run);

          // Xác định đường dẫn ảnh đúng
          $img = $featured['image'] ?? '';
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
            $img_path = 'images/placeholder.png'; // ảnh mặc định
          }
        ?>

          <!-- Featured Post -->
          <article class="featured-post d-flex align-items-center flex-wrap gap-4">
            <!-- Nội dung bài viết -->
            <div class="featured-post-content flex-grow-1">
              <div class="featured-post-author d-flex align-items-center mb-2">
                <img src="images/author.png" alt="author" class="mr-2" style="width:40px; height:40px;" />
                <p class="mb-0">By 
                  <span>
                    <?= htmlspecialchars(($featured['fname'] ?? '') . ' ' . ($featured['lname'] ?? '')) ?: 'Admin' ?>
                  </span>
                </p>
              </div>

              <!-- Tiêu đề bài viết -->
              <a href="single-blog.php?slug=<?= urlencode($featured['slug']) ?>" class="featured-post-title h4 d-block mb-2 text-decoration-none text-dark">
                <?= htmlspecialchars($featured['name']) ?>
              </a>

              <!-- Ngày đăng -->
              <ul class="featured-post-meta list-unstyled mb-2">
                <li><i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($featured['created_at'])) ?></li>
              </ul>

              <!-- Mô tả ngắn -->
              <p class="text-muted"><?= substr(strip_tags($featured['description']), 0, 150) ?>...</p>

              <!-- Nút đọc thêm -->
              <a href="single-blog.php?slug=<?= urlencode($featured['slug']) ?>" class="btn btn-outline-primary btn-sm mt-2">
                Read More <i class="fa fa-angle-right"></i>
              </a>
            </div>

            <!-- Ảnh bài viết -->
            <div class="featured-post-thumb text-right flex-shrink-0">
              <a href="single-blog.php?slug=<?= urlencode($featured['slug']) ?>">
                <img 
                  src="<?= htmlspecialchars($img_path) ?>" 
                  alt="<?= htmlspecialchars($featured['name']) ?>" 
                  style="width:350px; max-width:100%; border-radius:12px; object-fit:cover; box-shadow:0 4px 8px rgba(0,0,0,0.1); transition:transform 0.3s;"
                  onmouseover="this.style.transform='scale(1.03)'"
                  onmouseout="this.style.transform='scale(1)'"
                />
              </a>
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


