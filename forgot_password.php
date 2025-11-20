<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');

include('includes/config.php'); 
$page_title = "Quên Mật khẩu";
$meta_description = "Trang quên mật khẩu";
include('includes/header.php');


if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // 1. Kiểm tra email có tồn tại không
    $query = $con->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 0) {
        echo "Email không tồn tại!";
        exit;
    }

    // 2. Tạo token reset password
    $token = bin2hex(random_bytes(16)); // Token bảo mật cao
    $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // 3. Lưu token vào DB
    $update = $con->prepare("UPDATE users SET reset_token=?, reset_token_expires=? WHERE email=?");
    $update->bind_param("sss", $token, $expires, $email);
    $update->execute();

    // 4. Tạo link reset password
    $reset_link = "http://localhost/post-verse/reset_password.php?token=$token&email=$email";

    // 5. Gửi email bằng PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tongmaitruongvu11@gmail.com';
        $mail->Password = 'bcgo wwhv anof vilz'; // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('tongmaitruongvu11@gmail.com', 'Post Verse');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Reset Your Password";
        $mail->Body = "
        <h2>Reset Password</h2>
        <p>Click link để đặt lại mật khẩu:</p>
        <a href='$reset_link'>$reset_link</a>
    ";

        $mail->send();
        echo "Email đã được gửi!";
    } catch (Exception $e) {
        echo "Lỗi gửi mail: {$mail->ErrorInfo}";
    }
}


?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php // include('message.php'); // Nếu bạn có hệ thống message ?>
        
        <div class="card shadow-sm">
          <div class="card-header bg-danger text-white text-center">
            <h4>Quên Mật khẩu</h4>
          </div>
          <div class="card-body">
            <p class="text-center">Nhập địa chỉ Email của bạn. Chúng tôi sẽ gửi một liên kết để đặt lại mật khẩu.</p>
            <form method="POST" action="forgot_password.php">
              <div class="form-group">
                <label for="email">Địa chỉ Email</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Nhập Email đã đăng ký">
              </div>
              <button type="submit" name="forgot_btn" class="btn btn-danger btn-block mt-4">Gửi Link Đặt lại</button>
            </form>
          </div>
          <div class="card-footer text-center">
            <small>Đã nhớ mật khẩu? <a href="login.php">Đăng nhập ngay</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>