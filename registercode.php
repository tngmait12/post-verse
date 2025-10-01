<?php
session_start();
include('admin/config/dbcon.php');

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

            // Insert user into database
            $insert_query = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$hashed_password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $_SESSION['message'] = "Registration successful. You can now log in.";
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Registration failed. Please try again.";
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
