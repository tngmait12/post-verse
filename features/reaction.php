<?php
    if (!isset($con)) 
        include('../admin/config/dbcon.php');
    if(!isset($_SESSION))
        session_start();

    $user_id = $_SESSION['auth_user']['user_id'] ?? null;
    $source_reaction = $source_reaction ?? $_GET['source'] ?? '';
    $source_id = $source_id ?? $_GET['source_id'] ?? '';

    $query_reaction = "SELECT SUM(reaction = 'like') as like_count, 
                              SUM(reaction = 'dislike') as dislike_count 
                            FROM $source_reaction 
                            WHERE source_id = '$source_id'";

    $user_reaction = null;

    $stmt = mysqli_prepare($con, $query_reaction);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $like_count, $dislike_count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($user_id !== null) {
        $query_user_reaction = "SELECT reaction FROM $source_reaction WHERE source_id = $source_id AND user_id = $user_id LIMIT 1";
        $stmt_user = mysqli_prepare($con, $query_user_reaction);
        mysqli_stmt_execute($stmt_user);
        mysqli_stmt_bind_result($stmt_user, $user_reaction);
        mysqli_stmt_fetch($stmt_user);
        mysqli_stmt_close($stmt_user);
    }
?>

<div href="" class="d-inline text-primary like btn_reac" data-id="<?= $source_id ?>" data-status="like">
    <p class="d-inline ml-2"><?= $like_count ?? 0 ?></p> <i class="bi bi-hand-thumbs-up<?= ($user_reaction === 'like') ? '-fill' : '' ?>"></i>
</div>
<div href="" class="d-inline text-danger dislike btn_reac" data-id="<?= $source_id ?>" data-status="dislike">
    <p class="d-inline ml-2"><?= $dislike_count ?? 0 ?></p> <i class="bi bi-hand-thumbs-down<?= ($user_reaction === 'dislike') ? '-fill' : '' ?>"></i>
</div>
