<?php
    session_start();
    include('../admin/config/dbcon.php');

    if (!isset($_SESSION['auth_user']['user_id'])) {
        exit;
    }

    $reaction_id = $_POST['reaction_id'] ?? '';
    $user_id = $_SESSION['auth_user']['user_id'];
    $reaction_status = $_POST['reaction_status'] ?? '';
    $source = $_POST['source'] ?? '';

    echo json_encode([
        'reaction_id' => $reaction_id,
        'user_id' => $user_id,
        'reaction_status' => $reaction_status,
        'source' => $source
    ]);

    if ($reaction_id !== '' && $reaction_status !== '' && $source !== '') {
        $reaction_id = (int)$reaction_id;
        $check = mysqli_query($con, "SELECT * FROM $source WHERE id = $reaction_id");

        if (mysqli_num_rows($check) > 0) {
            $query = "UPDATE $source 
                        SET reaction = ?
                        WHERE source_id = ? AND user_id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'sis', $reaction_status, $reaction_id, $user_id);
            mysqli_stmt_execute($stmt);
        } else {
            $query = "INSERT INTO $source (source_id, user_id, reaction) 
                        VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'sis', $reaction_id, $user_id, $reaction_status);
            mysqli_stmt_execute($stmt);
        }
    }
    exit();
?>