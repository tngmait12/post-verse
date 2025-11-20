<?php
session_start();
include('admin/config/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_POST['register_btn'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if ($password == $cpassword) {
        // Check if email already exists
        $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($check_email_query_run) > 0) {
            // Email already exists
            $_SESSION['message'] = "Email already registered. Please use a different email.";
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
            header("Location: register.php");
            exit(0);
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Tao token xác thực
            $verification_token = bin2hex(random_bytes(32));
            
            $verification_link = "http://localhost/post-verse/verify_email.php?token=" . $verification_token . "&email=" . urlencode($email);

            // Insert user into database
            $insert_query = "INSERT INTO users (fname, lname, email, password, verification_token) VALUES ('$fname', '$lname', '$email', '$hashed_password', '$verification_token')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {

                // Gửi email xác thực bằng PHPMailer
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
                    $mail->Subject = "Xác thực tài khoản cho Nền tảng Post Verse";
                    $mail->Body = "Xin chào <b>$fname $lname</b>,<br><br>"
                        . "Cảm ơn bạn đã đăng ký tài khoản tại Post Verse. Vui lòng nhấp vào liên kết dưới đây để xác thực địa chỉ email của bạn:<br>"
                        . "<a href='$verification_link'><b>Nhấn vào đây để xác thực</b></a>"
                        . "<br><br>Nếu liên kết không hoạt động, bạn có thể sao chép và dán vào trình duyệt: $verification_link"
                        . "<br><br>Trân trọng,<br>Đội ngũ Post Verse.";

                    $mail->send();
                    echo "Email đã được gửi!";
                } catch (Exception $e) {
                    echo "Lỗi gửi mail: {$mail->ErrorInfo}";
                }

                $_SESSION['message'] = "Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản trước khi đăng nhập.";
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Đăng ký thất bại. Vui lòng thử lại.";
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['email'] = $email;
                header("Location: register.php");
                exit(0);
            }
        }
    } else {

        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;
        $_SESSION['message'] = "Password and Confirm Password doesn't match.";
        header("Location: register.php");
        exit(0);
    }
} else {
    header("Location: register.php");
    exit(0);
}
