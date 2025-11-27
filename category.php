<?php
include('includes/config.php');
include('config.php');

$slug = $_GET["slug"] ?? '';

$category_query = "SELECT * FROM categories WHERE slug='$slug' AND status='1' LIMIT 1";
$category_result = mysqli_query($con, $category_query);
$category_data = mysqli_fetch_assoc($category_result);

if ($category_data) {
    $category_id = $category_data['id'];

    $page_title = $category_data['meta_title'];

    $posts_query = "
          SELECT 
              p.*, 
              c.name AS cname,
              c.slug AS category_slug, 
              u.fname, 
              u.lname
          FROM posts p
          JOIN categories c ON p.category_id = c.id
          JOIN users u ON p.user_id = u.id
          WHERE p.category_id = '$category_id' AND p.status='1'
          ORDER BY p.created_at DESC
          LIMIT 10
      ";
    $posts_result = mysqli_query($con, $posts_query);


    //count posts in category for display in header
    $count_query = "
          SELECT COUNT(id) AS total_posts
          FROM posts 
          WHERE category_id = '$category_id' AND status='1'
      ";
    $count_result = mysqli_query($con, $count_query);
    $count_data = mysqli_fetch_assoc($count_result);
    $total_posts = $count_data['total_posts'];
} else {
    // Xử lý nếu Category không tồn tại
    $page_title = "Không tìm thấy danh mục";
}

include('includes/header.php');
?>

<section class="blog">
    <div class="container">

        <?php include('message.php'); // Hiển thị thông báo session 
        ?>

        <?php if ($category_data) : ?>

            <div class="category-header mb-5 pb-3 border-bottom border-secondary">

                <h1 class="h2 font-weight-bold text-dark mb-1">
                    <i class="fa fa-folder-open-o mr-2 text-primary"></i> <?= $category_data['name']; ?>
                </h1>

                <p class="lead text-muted small mb-0">
                    <?= $category_data['description']; ?>
                </p>

                <small class="text-secondary">
                    (Tìm thấy <?= $total_posts; ?> bài viết trong danh mục này)
                </small>
            </div>

            <div class="row">

                <div class="col-lg-8">
                    <h3 class="mb-4">Bài viết liên quan</h3>

                    <?php if (mysqli_num_rows($posts_result) > 0) : ?>

                        <?php while ($row = mysqli_fetch_assoc($posts_result)) : ?>
                            <article class="blog-post">
                                <div class="blog-post-thumb">
                                    <?php
                                    $image_source = !empty($post_result['image'])
                                        ? "uploads/posts/" . $post_result['image']
                                        : "uploads/imgs/post.png";
                                    ?>
                                    <img src="<?= $image_source ?>" width="100%" alt="banner" />
                                </div>
                                <div class="blog-post-content">
                                    <div class="blog-post-tag">
                                        <a href="category.php?slug=<?php echo $row['category_slug']; ?>"><?= $row['cname'] ?></a>
                                    </div>
                                    <div class="blog-post-title">
                                        <a href="single-blog.php?slug=<?php echo $row['slug'] ?>">
                                            <?php echo $row['name'] ?>
                                        </a>
                                    </div>
                                    <div class="blog-post-meta">
                                        <ul>
                                            <li>By <a href="profile-user.php?id=<?= $row['user_id']; ?>"><?= $row['fname'] . ' ' . $row['lname'] ?></a></li>
                                            <li>
                                                <i class="fa fa-clock-o"></i>
                                                <?php
                                                $created_at = strtotime($row['created_at']);
                                                echo date('F j, Y, H:i', $created_at);
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>
                                        <?= $row['meta_description'] ?>
                                    </p>
                                    <a href="single-blog.php?slug=<?php echo $row['slug'] ?>" class="blog-post-action">read more <i class="fa fa-angle-right"></i></a>
                                </div>
                            </article>
                        <?php endwhile; ?>

                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                            </ul>
                        </nav>

                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            Hiện chưa có bài viết nào trong danh mục này.
                        </div>
                    <?php endif; ?>

                </div>

                <?php include('section/list-categories.php') ?>
            </div>

        <?php else : ?>
            <div class="alert alert-danger text-center py-5">
                <h4 class="alert-heading">404 - Không tìm thấy Danh mục!</h4>
                <p>Danh mục với slug <?= $slug; ?>không tồn tại hoặc đã bị ẩn.</p>
                <a href="index.php" class="btn btn-primary mt-3">Quay về Trang chủ</a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
include('includes/footer.php');
?>