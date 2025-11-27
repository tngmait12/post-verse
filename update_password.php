<?php
include('includes/config.php'); 


if(isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['cpassword'])) {
    
    $email = $_POST['email'];
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $cpassword = $_POST['cpassword'];
    
    if ($new_password !== $cpassword) {
        $_SESSION['message'] = "Mật khẩu mới và Xác nhận Mật khẩu không khớp.";
        header('Location: reset_password.php?token=' . urlencode($token) . '&email=' . urlencode($email));
        exit();
    }

    $newPass = password_hash($new_password, PASSWORD_BCRYPT);

    $query = $con->prepare("UPDATE users SET password=?, reset_token=NULL, reset_token_expires=NULL WHERE email=?");
    $query->bind_param("ss", $newPass, $email);
    
    if ($query->execute()) {
        $_SESSION['message'] = "Đặt lại mật khẩu thành công! Bạn có thể đăng nhập.";
        header('Location: login.php');
    } else {
        echo "Lỗi cập nhật mật khẩu: " . $query->error;
    }
}
?>