<?php
include('includes/config.php');

$page_title = "Search Results";
$meta_description = "Search results page";
$meta_keyword = "search, blog, php";

include('includes/header.php');
?>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="mb-4">Search Results</h2>

        <?php
        if (isset($_GET['q']) && $_GET['q'] != '') {
          $search = mysqli_real_escape_string($con, $_GET['q']);

          // Tìm bài viết theo từ khóa trong tiêu đề hoặc mô tả
          $query = "SELECT * FROM posts 
                    WHERE status = 0 
                    AND (name LIKE '%$search%' 
                    OR meta_description LIKE '%$search%' 
                    OR meta_keyword LIKE '%$search%')
                    ORDER BY created_at DESC";

          $query_run = mysqli_query($con, $query);

          if ($query_run && mysqli_num_rows($query_run) > 0) {
            while ($post = mysqli_fetch_assoc($query_run)) {
        ?>
              <article class="blog-post mb-4">
                <div class="blog-post-thumb">
                  <img src="uploads/posts/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['name']) ?>" class="img-fluid rounded" style="max-width:200px;" />
                </div>
                <div class="blog-post-content">
                  <h3>
                    <a href="single-blog.php?slug=<?= urlencode($post['slug']) ?>">
                      <?= htmlspecialchars($post['name']) ?>
                    </a>
                  </h3>
                  <ul class="blog-post-meta">
                    <li><i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($post['created_at'])) ?></li>
                  </ul>
                  <p><?= substr(strip_tags($post['meta_description']), 0, 150) ?>...</p>
                </div>
              </article>
        <?php
            }
          } else {
            echo "<p>No results found for '<strong>$search</strong>'.</p>";
          }
        } else {
          echo "<p>Please enter a keyword to search.</p>";
        }
        ?>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>
