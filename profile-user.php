<?php

// Bao gồm file cấu hình và kết nối CSDL (Giả sử $con được khởi tạo ở đây)
include('includes/config.php');

// 1. KIỂM TRA ĐĂNG NHẬP
if (!isset($_SESSION['auth_user']['user_id'])) {
    $_SESSION['message'] = "Bạn cần đăng nhập để truy cập trang cá nhân.";
    // Chuyển hướng về trang đăng nhập hoặc trang chủ
    header("Location: login.php"); 
    exit();
}


$user_id = $_SESSION['auth_user']['user_id'];
$user_data = [];
$user_posts = [];

// --- A. LẤY THÔNG TIN NGƯỜI DÙNG (Sử dụng Prepared Statements) ---
$query_user = "SELECT fname, lname, email, created_at FROM users WHERE id = ? LIMIT 1";
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


// --- B. LẤY CÁC BÀI VIẾT CỦA NGƯỜI DÙNG (Sử dụng Prepared Statements) ---
// Lấy các cột cần thiết: id, name (tiêu đề), slug (để tạo link nếu cần), description (nội dung tóm tắt), created_at
$query_posts = "SELECT id, name, slug, description, created_at, user_id FROM posts WHERE user_id = ? ORDER BY created_at DESC";
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

// Bao gồm Header (Nơi chứa liên kết Bootstrap)
include('includes/header.php'); 
?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">📋 Trang Cá Nhân: <?= htmlspecialchars($user_data['fname'] ?? '') . ' ' . htmlspecialchars($user_data['lname'] ?? '') ?></h2>
    <hr>
    
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <img src="uploads/profiles/default.png" alt="Ảnh đại diện" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="card-title mt-3">
                        <?= htmlspecialchars($user_data['fname'] ?? '') . ' ' . htmlspecialchars($user_data['lname'] ?? 'N/A') ?>
                    </h5>
                    <p class="card-text text-muted">
                        <?= htmlspecialchars($user_data['email'] ?? 'N/A') ?>
                    </p>
                    <small class="text-secondary">
                        Thành viên từ: 
                        <?php 
                            if (isset($user_data['created_at'])) {
                                echo date('d/m/Y', strtotime($user_data['created_at']));
                            } else {
                                echo 'Không xác định';
                            }
                        ?>
                    </small>
                    <hr>
                    <a href="admin/profile-edit.php" class="btn btn-sm btn-outline-primary w-100">Chỉnh sửa Hồ sơ</a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <h3 class="mb-3">✍️ Các bài viết đã đăng</h3>

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
                            
                            <div class="btn-group" role="group">
                                <a href="admin/view-posts.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-success" title="Chỉnh sửa bài viết">
                                    <i class="fa fa-pencil"></i> Sửa
                                </a>
                                <a href="admin/view-posts.php?id=<?= $post['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');" class="btn btn-sm btn-danger" title="Xóa bài viết">
                                    <i class="fa fa-trash"></i> Xóa
                                </a>
                            </div>
                        </div>

                        <hr class="mt-2 mb-2">
                        <p class="card-text">
                            <?= substr(strip_tags($post['description']), 0, 150) ?>...
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
// Bao gồm Footer (Nơi chứa liên kết JS Bootstrap)
include('includes/footer.php'); 

?>

