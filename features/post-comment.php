<?php
    session_start();
    include('../admin/config/dbcon.php');

    if (isset($_SESSION['auth_user'], $_POST['cmt']) && $_POST['cmt'] != "") {
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['auth_user']['user_id'];
        $content = $_POST['cmt'];

        $query = "INSERT INTO comments (post_id, user_id, content) 
                    VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'iis', $post_id, $user_id, $content);
        $success = mysqli_stmt_execute($stmt);
        
        if (!$success) {
            $_SESSION['message'] = 'Comments not yet sent!';
        }
        exit();
    }
    else echo 'false';
?>