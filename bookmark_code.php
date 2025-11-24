<?php
session_start();
include('admin/config/dbcon.php'); // Kết nối CSDL

// Kiểm tra đăng nhập
if (!isset($_SESSION['auth']) || !isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "Bạn cần đăng nhập để thực hiện chức năng này.";
    // Chuyển hướng người dùng trở lại trang trước hoặc trang đăng nhập
    $redirect_url = $_SERVER['HTTP_REFERER'] ?? 'login.php'; 
    header("Location: " . $redirect_url);
    exit(0);
}

// 1. Lấy dữ liệu
$user_id = $_SESSION['auth_user']['user_id'];
// Lưu ý: Đảm bảo trường post_id được gửi qua form POST
if (!isset($_POST['post_id'])) {
    $_SESSION['message'] = "Thiếu thông tin bài viết.";
    header("Location: index.php");
    exit(0);
}

$post_id = mysqli_real_escape_string($con, $_POST['post_id']);

// 2. Kiểm tra trạng thái hiện tại (Đã lưu hay chưa)
$check_query = "SELECT * FROM user_bookmarks WHERE user_id='$user_id' AND post_id='$post_id' LIMIT 1";
$check_run = mysqli_query($con, $check_query);

if (mysqli_num_rows($check_run) > 0) 
{
    // Đã lưu -> BỎ LƯU (DELETE)
    $delete_query = "DELETE FROM user_bookmarks WHERE user_id='$user_id' AND post_id='$post_id'";
    $delete_run = mysqli_query($con, $delete_query);

    if ($delete_run) {
        $_SESSION['message'] = "Bài viết đã được **bỏ lưu**.";
    } else {
        $_SESSION['message'] = "Lỗi khi bỏ lưu.";
    }
} 
else 
{
    // Chưa lưu -> THÊM LƯU (INSERT)
    $insert_query = "INSERT INTO user_bookmarks (user_id, post_id) VALUES ('$user_id', '$post_id')";
    $insert_run = mysqli_query($con, $insert_query);

    if ($insert_run) {
        $_SESSION['message'] = "Bài viết đã được **lưu** thành công.";
    } else {
        $_SESSION['message'] = "Lỗi khi lưu bài viết.";
    }
}

// Chuyển hướng về trang trước đó
$redirect_url = $_SERVER['HTTP_REFERER'] ?? 'index.php'; 
header("Location: " . $redirect_url);
exit(0);
?>