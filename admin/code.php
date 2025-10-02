<?php 
include('authentication.php');

if(isset($_POST['add_user'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    // Check if email already exists
    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['message'] = "Email Already Exists";
        header('Location: add-register.php');
        exit(0);
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (fname, lname, email, password, role_as, status) VALUES ('$fname', '$lname', '$email', '$hashed_password', '$role_as', '$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "User Added Successfully";
            header('Location: view-register.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "User Not Added";
            header('Location: add-register.php');
            exit(0);
        }
    }
}

if(isset($_POST['update_user'])){
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';
    $password = $_POST['password'];

    $query = "UPDATE users SET fname='$fname', lname='$lname', role_as='$role_as', status='$status' WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        if(!empty($password)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_password = "UPDATE users SET password='$hashed_password' WHERE id='$user_id' ";
            $update_password_run = mysqli_query($con, $update_password);
        }
        $_SESSION['message'] = "User Updated Successfully";
        header('Location: view-register.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "User Not Updated";
        header('Location: view-register.php');
        exit(0);
    }
}

if(isset($_POST['delete_user'])){
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "User Deleted Successfully";
        header('Location: view-register.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "User Not Deleted";
        header('Location: view-register.php');
        exit(0);
    }
}
?>