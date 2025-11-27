<?php
  $latest_post_slug = "#";
  $latest_query = "SELECT slug FROM posts WHERE status='1' ORDER BY id DESC LIMIT 1";
  $latest_result = mysqli_query($con, $latest_query);
  if ($latest_result && mysqli_num_rows($latest_result) > 0) {
      $latest_post = mysqli_fetch_assoc($latest_result);
      $latest_post_slug = "single-blog.php?slug=" . $latest_post['slug'];
    }
?>

<section class="hero-section py-5">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-7 col-md-12 mb-4 mb-lg-0">
        <div class="p-3">

          <h1 class="display-3 font-weight-bold mb-3 text-primary">
            Chào mừng đến với Post Verse
          </h1>

          <p class="lead mb-4 text-secondary">
            Nền tảng chia sẻ và quản lý bài viết hàng đầu, tập trung vào lĩnh vực **kiến thức lập trình, công nghệ, và phát triển mã nguồn mở**.
          </p>

          <ul class="list-unstyled mb-4">
            <li><i class="fa fa-check-circle text-success mr-2"></i> Kiến thức lập trình từ cơ bản đến nâng cao.</li>
            <li><i class="fa fa-share-alt text-success mr-2"></i> Cộng đồng chia sẻ, bình luận và tương tác trực tuyến.</li>
            <li><i class="fa fa-code text-success mr-2"></i> Nội dung chất lượng, được quản lý chặt chẽ.</li>
          </ul>

          <a href="register.php" class="btn btn-primary btn-lg shadow-sm mr-3">
            Tham gia ngay <i class="fa fa-arrow-right ml-2"></i>
          </a>
          <a href="<?= $latest_post_slug ?>" class="btn btn-outline-secondary btn-lg">
            Đọc bài viết <i class="fa fa-book ml-2"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-5 col-md-12 text-center">
        <img src="uploads/imgs/about.png"
          alt="Post Verse Coding Illustration"
          class="img-fluid rounded shadow-lg"
          style="max-height: 400px; object-fit: cover;">
        <p class="text-muted mt-2 small">Chia sẻ kiến thức, kết nối cộng đồng.</p>
      </div>

    </div>
  </div>
</section>