<?php
include('includes/config.php');
include('config.php');

$page = $_GET["page"] ?? 1;
define('POSTS_IN_PAGE', 3);

$user_id = $_GET['id'] ?? null;

$user_data = [];
$user_posts = [];

$count_post = "SELECT COUNT(*) AS count FROM posts WHERE status = 1 and user_id = " . intval($user_id);
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
        FROM posts AS p 
        JOIN users AS u ON p.user_id = u.id 
        JOIN categories AS c ON p.category_id = c.id 
        WHERE p.status = 1 and p.user_id = ?
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

$current_user_id = $_SESSION['auth_user']['user_id'] ?? null;
$current_user_role = $_SESSION['auth_user']['role_as'] ?? 0;

$is_author_or_admin = ($current_user_id && ($current_user_id == $user_id || $current_user_role == 1));

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
                    if (!empty($user_data['image'])) {
                        $imagePath = "uploads/users/" . htmlspecialchars($user_data['image']);
                    } else {
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
                        Email: <?= htmlspecialchars($user_data['email'] ?? 'N/A') ?>
                    </p>

                    <?php if (!empty($user_data['phone'])): ?>
                        <p class="card-text">Phone Number: <?= htmlspecialchars($user_data['phone']) ?></p>
                    <?php endif; ?>

                    <?php if (!empty($user_data['gender'])): ?>
                        <p class="card-text"><?= ucfirst($user_data['gender']) ?></p>
                    <?php endif; ?>

                    <small class="text-secondary">
                        Thành viên từ:
                        <?= isset($user_data['created_at'])
                            ? date('d/m/Y', strtotime($user_data['created_at']))
                            : 'Không xác định'; ?>
                    </small>

                    <hr>
                    <?php if ($is_author_or_admin) : ?>
                        <a href="bookmark.php" class="btn btn-warning btn-sm shadow-sm mb-2">
                            <i class="fa fa-bookmark"></i> đã lưu
                        </a>
                        <a href="admin/profile-edit.php" class="btn btn-sm btn-outline-primary w-100">Chỉnh sửa Hồ sơ</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Bài viết của người dùng -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="mb-0">✍️ Các bài viết đã đăng</h3>
                <div class="d-flex">
                    <?php if ($is_author_or_admin) : ?>
                        <a href="admin/add-post.php" class="btn btn-primary btn-sm shadow-sm ml-3">
                            <i class="fa fa-plus"></i> Tạo bài viết
                        </a>
                    <?php endif; ?>
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
                                <?php if ($is_author_or_admin) : ?>
                                    <a href="admin/edit-post.php?id=<?= $row['id'] ?>"
                                        class="text-info text-decoration-none ml-2"
                                        data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                        <i class="fa fa-pencil fa-sm"></i>
                                    </a>

                                    <form action="admin/code.php" method="POST" class="d-inline ml-1" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                        <button type="submit" name="delete_post" value="<?= $row['id']; ?>"
                                            class="btn btn-danger btn-sm text-decoration-none ml-2 text-dark"
                                            style="min-width: 40px !important;"
                                            data-toggle="tooltip" data-placement="top" title="Xóa">
                                            <i class="fa fa-trash-o fa-sm"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
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