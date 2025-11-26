<?php
    session_start();
    include('../admin/config/dbcon.php');

    if (!isset($_SESSION['auth_user'])) {
        $_SESSION['message'] = 'Login to commment!';
        exit();
    }

    if (isset($_POST['cmt']) && $_POST['cmt'] != "") {
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['auth_user']['user_id'];
        $reply = $_POST['reply'];
        $reply = ($reply == '') ? null : $reply;
        $content = $_POST['cmt'];

        if ($reply != null) {
            $parent_query = "SELECT parent_id FROM comments WHERE id = ?";

            $p_stmt = mysqli_prepare($con, $parent_query);
            mysqli_stmt_bind_param($p_stmt, 'i', $reply);
            mysqli_stmt_execute($p_stmt);
            $p_result = mysqli_stmt_get_result($p_stmt);
            
            $result = mysqli_fetch_row($p_result)[0];
            $parent_id = $result != null ? $result : $reply;
        } else {
            $parent_id = null;
        }

        $query = "INSERT INTO comments (post_id, user_id, parent_id, reply, content) 
                    VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'iiiis', $post_id, $user_id, $parent_id, $reply, $content);
        $success = mysqli_stmt_execute($stmt);

        echo $content;   
        exit();
    }
    exit();
?>