<!DOCTYPE html>
<html lang="en">
<head>
    <style> /* Cần phải có thẻ <style> */
    .btn {
        padding: 10px 20px !important;
        margin: 3px;
        min-width: 20px !important;
        font-size: 14px !important;
    }
    </style>
</head>
<body>
    </body>
</html>
<?php
include('includes/config.php');

// 1. KIỂM TRA ĐĂNG NHẬP
if (!isset($_SESSION['auth_user']['user_id'])) {
    $_SESSION['message'] = "Bạn cần đăng nhập để truy cập trang cá nhân.";
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['auth_user']['user_id'];
$user_data = [];
$user_posts = [];

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
$query_posts = "SELECT id, name, slug, description, image, created_at 
                FROM posts 
                WHERE user_id = ? 
                ORDER BY created_at DESC";
$stmt_posts = mysqli_prepare($con, $query_posts);

if ($stmt_posts) {
    mysqli_stmt_bind_param($stmt_posts, 'i', $user_id);
    mysqli_stmt_execute($stmt_posts);
    $result_posts = mysqli_stmt_get_result($stmt_posts);

    if (mysqli_num_rows($result_posts) > 0) {
        while($row = mysqli_fetch_assoc($result_posts)){
            $user_posts[] = $row;
        }
    }
    mysqli_stmt_close($stmt_posts);
}

include('includes/header.php');
?>

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
                        $imagePath = "uploads/users/default.png";
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
    <h3 class="mb-0">✍️ Các bài viết đã đăng</h3>
    <a href="admin/add-post.php" class="btn btn-primary ms-auto">
        <i class="fa fa-plus"></i> Tạo bài viết mới
    </a>
</div>

            <?php if (count($user_posts) > 0): ?>
    <?php foreach ($user_posts as $post): ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">
                            <a href="single-blog.php?slug=<?= htmlspecialchars($post['slug']) ?>" class="text-decoration-none">
                                <?= htmlspecialchars($post['name']) ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted small mb-1">
                            Ngày đăng: <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                        </p>
                    </div>

                    <!-- Nút Sửa / Xóa -->
                    <div class="" role="group" ">
                        <a href="admin/edit-post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-success" title="Chỉnh sửa bài viết">
                            <i class="fa fa-pencil"></i> Sửa
                        </a>
                        <form action="admin/code.php" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                            <input type="hidden" name="delete_post" value="<?= $post['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa bài viết">
                                <i class="fa fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>

                <?php if (!empty($post['image']) && file_exists("uploads/posts/" . $post['image'])): ?>
                    <img src="uploads/posts/<?= $post['image'] ?>" class="img-fluid mb-2" style="max-height:200px; object-fit:cover;">
                <?php endif; ?>

                <hr class="mt-2 mb-2">
                <p class="card-text">
               <?= substr(strip_tags($post['description'] ?? ''), 0, 150) ?>...

                </p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-info">
        Bạn chưa đăng bất kỳ bài viết nào.
    </div>
<?php endif; ?>

        </div>
    </div>
</div>

<?php 
include('includes/footer.php');
include('includes/script.php');
?>

