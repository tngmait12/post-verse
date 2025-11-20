<?php
session_start();
include('admin/config/dbcon.php'); 

if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = mysqli_real_escape_string($con, $_GET['token']);
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $current_time = date('Y-m-d H:i:s');

    // 1. Tìm người dùng với token và email khớp, và chưa được xác minh
    $check_query = "SELECT * FROM users WHERE email='$email' AND verification_token='$token' AND email_verified_at IS NULL LIMIT 1";
    $check_query_run = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_query_run) > 0) {
        
        // 2. CẬP NHẬT TRẠNG THÁI XÁC MINH
        $update_query = "UPDATE users SET email_verified_at = '$current_time', verification_token = NULL WHERE email = '$email' AND verification_token = '$token'";
        $update_query_run = mysqli_query($con, $update_query);

        if ($update_query_run) {
            $_SESSION['message'] = "Xác thực email thành công! Bạn có thể đăng nhập ngay.";
            header("Location: login.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Lỗi trong quá trình cập nhật CSDL. Vui lòng thử lại.";
            header("Location: login.php");
            exit(0);
        }
    } 
    else 
    {
        // Kiểm tra nếu đã xác minh rồi
        $already_verified_query = "SELECT * FROM users WHERE email='$email' AND email_verified_at IS NOT NULL LIMIT 1";
        $already_verified_run = mysqli_query($con, $already_verified_query);
        
        if (mysqli_num_rows($already_verified_run) > 0) {
             $_SESSION['message'] = "Tài khoản đã được xác thực trước đó.";
        } else {
            $_SESSION['message'] = "Liên kết xác thực không hợp lệ hoặc đã hết hạn.";
        }
        header("Location: login.php");
        exit(0);
    }
} else {
    // Không có token hoặc email
    $_SESSION['message'] = "Yêu cầu xác thực không hợp lệ.";
    header("Location: login.php");
    exit(0);
}

// Có thể thêm HTML cơ bản để hiển thị thông báo nếu không muốn dùng session message
?>