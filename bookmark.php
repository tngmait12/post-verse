<?php
include('includes/config.php');
include('config.php');

$page = $_GET["page"] ?? 1;
define('POSTS_IN_PAGE', 3);

$user_id = $_SESSION['auth_user']['user_id'] ?? null;

$user_data = [];
$user_posts = [];

$count_post = "SELECT COUNT(*) AS count FROM user_bookmarks WHERE user_id = " . intval($user_id);
$count = (int)mysqli_query($con, $count_post)->fetch_assoc()['count'];
$pagination = ceil($count / POSTS_IN_PAGE);

// --- A. LẤY THÔNG TIN NGƯỜI DÙNG (có avatar, phone, social, gender) ---
$query_user = "SELECT fname, lname, email, created_at, image, phone, gender 
               FROM users 
               WHERE id = ? 
               LIMIT 1";
$stmt_user = mysqli_prepare($con, $query_user);

if ($stmt_user) {
    mysqli_stmt_bind_param($stmt_user, 'i', $user_id);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);

    if (mysqli_num_rows($result_user) > 0) {
        $user_data = mysqli_fetch_assoc($result_user);
    }
    mysqli_stmt_close($stmt_user);
}

// --- B. LẤY CÁC BÀI VIẾT CỦA NGƯỜI DÙNG ---

$query = 'SELECT p.*, u.fname, u.lname, c.name AS category_name , c.slug AS category_slug
        FROM user_bookmarks AS ub 
        JOIN posts AS p ON p.id = ub.post_id 
        JOIN users AS u ON p.user_id = u.id 
        JOIN categories AS c ON p.category_id = c.id
        WHERE p.status = 1 AND ub.user_id = ?
        ORDER BY p.id DESC
        LIMIT ' . POSTS_IN_PAGE . ' 
        OFFSET ' . (($page - 1) * POSTS_IN_PAGE);

//$stmt_posts = mysqli_prepare($con, $query_posts);

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$rows_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

$count_post = count($rows_result);

include('includes/header.php');
?>
<style>
    .btn-sm {
        padding: 0.3rem 0.5rem !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
    }
</style>
<div class="container mt-5 mb-5">
    <h2 class="mb-4">📋 Trang Cá Nhân:
        <?= htmlspecialchars($user_data['fname'] ?? '') . ' ' . htmlspecialchars($user_data['lname'] ?? '') ?>
    </h2>
    <hr>

    <div class="row">
        <!-- Thông tin người dùng -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">

                    <?php
                    // Kiểm tra avatar
                    $imageFile = $user_data['image'] ?? '';
                    $imagePath = "uploads/users/" . $imageFile;
                    if (!file_exists($imagePath) || empty($imageFile)) {
                        $imagePath = "images/user.png";
                    }
                    ?>

                    <img src="<?= $imagePath ?>"
                        alt="Ảnh đại diện"
                        class="img-fluid rounded-circle"
                        style="width: 150px; height: 150px; object-fit: cover;">

                    <h5 class="card-title mt-3">
                        <?= htmlspecialchars($user_data['fname'] ?? '') . ' ' . htmlspecialchars($user_data['lname'] ?? '') ?>
                    </h5>

                    <p class="card-text text-muted">
                        <?= htmlspecialchars($user_data['email'] ?? 'N/A') ?>
                    </p>

                    <?php if (!empty($user_data['phone'])): ?>
                        <p class="card-text">📞 <?= htmlspecialchars($user_data['phone']) ?></p>
                    <?php endif; ?>

                    <?php if (!empty($user_data['gender'])): ?>
                        <p class="card-text">⚧ <?= ucfirst($user_data['gender']) ?></p>
                    <?php endif; ?>

                    <small class="text-secondary">
                        Thành viên từ:
                        <?= isset($user_data['created_at'])
                            ? date('d/m/Y', strtotime($user_data['created_at']))
                            : 'Không xác định'; ?>
                    </small>

                    <hr>
                    <a href="admin/profile-edit.php" class="btn btn-sm btn-outline-primary w-100">Chỉnh sửa Hồ sơ</a>
                </div>
            </div>
        </div>

        <!-- Bài viết của người dùng -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="mb-0">✍️ Các bài viết đã lưu</h3>
                <div class="d-flex">

                    <a href="profile-user.php?id=<?= $user_id; ?>" class="btn btn-success btn-sm shadow-sm">
                        Bài viết của tôi
                    </a>

                    <a href="admin/add-post.php" class="btn btn-primary btn-sm shadow-sm ml-3">
                        <i class="fa fa-plus"></i> Tạo bài viết
                    </a>

                </div>
            </div>

            <?php if (count($rows_result) > 0): ?>
                <?php foreach ($rows_result as $row): ?>
                    <article class="blog-post">
                        <div class="blog-post-thumb">
                            <?php
                            $image_source = !empty($row['image'])
                                ? "uploads/posts/" . $row['image']
                                : "uploads/imgs/post.png";
                            ?>
                            <img src="<?= $image_source ?>" alt="blog-thum" />
                        </div>
                        <div class="blog-post-content">
                            <div class="blog-post-tag">
                                <a href="category.php?slug=<?php echo $row['category_slug']; ?>"><?= $row['category_name'] ?></a>
                                <form action="bookmark_code.php" method="POST" class="m-0 p-0 d-inline">
                                    <input type="hidden" name="post_id" value="<?= $row['id']; ?>">

                                    <button type="submit" name="bookmark_btn"
                                        class="btn btn-sm p-0 m-0 btn-warning"
                                        style="min-width: 40px !important;"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Bỏ Lưu Bài viết">

                                        <i class="fa <?= $is_bookmarked ? 'fa-bookmark' : 'fa-bookmark-o'; ?>"></i>
                                    </button>
                                </form>
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
                <?php endforeach; ?>

                <div class="blog-post-pagination">
                    <nav aria-label="Page navigation example" class="nav-bg">
                        <ul class="pagination">
                            <?php if ($pagination > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=<?= 1 ?>">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $pagination; $i++): ?>
                                    <li class="page-item"><a class="page-link <?php if ($i == $page) echo "active"; ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=<?= $pagination ?>">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            <?php else: ?>
                <h2>Không có bài viết nào</h2>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>