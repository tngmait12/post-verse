<?php 
session_start();
include('admin/config/dbcon.php');

if(isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0) {
        $user = mysqli_fetch_array($login_query_run);
        if(password_verify($password, $user['password'])) {
            // Password is correct

            foreach($login_query_run as $data) {
                // You can access user data here if needed
                $user_id = $data['id'];
                $user_name = $data['fname']." ".$data['lname'];
                $user_email = $data['email'];
                $role_as = $data['role_as'];
            }

            $_SESSION['auth'] = true;
            $_SESSION['auth_role'] = "$role_as"; // 1=author, 0=user, 2 = admin
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_email' => $user_email
            ];

            if($_SESSION['auth_role'] == "1") {
                $_SESSION['message'] = "Welcome to the Admin Dashboard, ".$user['fname']."!";
                header("Location: admin/index.php");
                exit(0);
            }
            if($_SESSION['auth_role'] == "2") {
                $_SESSION['message'] = "Welcome to the Admin Dashboard, ".$user['fname']."!";
                header("Location: admin/index.php");
                exit(0);
            }
            else {
                $_SESSION['message'] = "Login successful. Welcome ".$user['fname']."!";
                header("Location: index.php");
                exit(0);
            }

            $_SESSION['message'] = "Login successful. Welcome ".$user['fname']."!";
            header("Location: index.php");
            exit(0);
        } else {
            // Invalid password
            $_SESSION['message'] = "Invalid Email or Password.";
            header("Location: login.php");
            exit(0);
        }
    } else {
        // No user found with that email
        $_SESSION['message'] = "No user found with that email.";
        header("Location: login.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "No user found with that email.";
    header("Location: login.php");
    exit(0);
}

?>