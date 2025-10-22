<?php
    session_start();
    include('../admin/config/dbcon.php');

    $source_id = $_POST['source_id'] ?? '';
    $user_id = $_SESSION['auth_user']['user_id'] ?? null;
    $reaction_status = $_POST['reaction_status'] ?? '';
    $source = $_POST['source'] ?? '';

    $json_response = ['status' => 'error'];

    if ($user_id === null) {
        echo json_encode($json_response);
        exit;
    }

    if ($reaction_status != 'like' && $reaction_status != 'dislike') {
        echo json_encode($json_response);
        exit;
    }

    if ($source_id === '' || $reaction_status === '' || $source === '') {
        echo json_encode($json_response);
        exit;
    }

    $source_id = (int)$source_id;
    $check_reac = mysqli_query($con, "SELECT * FROM $source WHERE source_id = $source_id AND user_id = $user_id");

    if (mysqli_num_rows($check_reac) === 0) {
        $query = "INSERT INTO $source (source_id, user_id, reaction) 
                    VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'iis', $source_id, $user_id, $reaction_status);
        $result = mysqli_stmt_execute($stmt);
        if ($result) $json_response['status'] = $reaction_status;
    } else {
        $current_reac = mysqli_fetch_assoc($check_reac);
        
        if ($reaction_status == $current_reac['reaction']) {
            $stmt = mysqli_prepare($con, "DELETE FROM $source WHERE source_id = $source_id AND user_id = $user_id");
            $result = mysqli_stmt_execute($stmt);

            if ($result) $json_response['status'] = 'removed';
        } else {
            $stmt = mysqli_prepare($con, "UPDATE $source SET reaction = ? WHERE source_id = ? AND user_id = ?");
            mysqli_stmt_bind_param($stmt, 'sii', $reaction_status, $source_id, $user_id);
            $result = mysqli_stmt_execute($stmt);

            if ($result) $json_response['status'] = $reaction_status;
        }
    }
    echo json_encode($json_response);
    exit();
?>