<?php
include('includes/config.php'); 
// Bổ sung session_start() nếu bạn muốn sử dụng $_SESSION['message']
// session_start(); 

if(isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['cpassword'])) {
    
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $cpassword = $_POST['cpassword'];
    
    if ($new_password !== $cpassword) {
        // Xử lý lỗi: Mật khẩu không khớp
        // $_SESSION['message'] = "Mật khẩu mới và Xác nhận Mật khẩu không khớp.";
        // header('Location: reset_password.php?token=...'); // chuyển hướng về trang cũ
        echo "Mật khẩu mới và Xác nhận Mật khẩu không khớp.";
        exit;
    }

    $newPass = password_hash($new_password, PASSWORD_BCRYPT);

    // Chuẩn bị update mật khẩu
    $query = $con->prepare("UPDATE users SET password=?, reset_token=NULL, reset_token_expires=NULL WHERE email=?");
    $query->bind_param("ss", $newPass, $email);
    
    if ($query->execute()) {
        // $_SESSION['message'] = "Đặt lại mật khẩu thành công! Bạn có thể đăng nhập.";
        // header('Location: login.php');
        echo "Đặt lại mật khẩu thành công! Bạn có thể <a href='login.php'>đăng nhập</a>.";
    } else {
        echo "Lỗi cập nhật mật khẩu: " . $query->error;
    }
}
?>