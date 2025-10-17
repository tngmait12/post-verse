<?php
    include('../admin/config/dbcon.php');

    $query = "SELECT c.*, u.lname, u.fname
                FROM comments AS c 
                JOIN users AS u ON c.user_id = u.id
                WHERE c.parent_id = ?";

    $stmt = mysqli_prepare($con, $query);

    if (isset($_GET['parent_id'])) {
        $id = $_GET['parent_id'];

        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num_replies = mysqli_num_rows($result);
    }
?>
<div class="reply-box pl-3">
    <?php while ($reply = $result->fetch_assoc()): ?>
        <div class="comment-box mt-3">
            <div class="name-field">
                <?= $reply['fname'] . " " . $reply['lname'] ?>
            </div>
            <div class="content-field">
                <?= $reply['content'] ?>
            </div>
            <div style="color: #1877F2;">
                <i class="fa fa-clock-o pl-2"></i>
                <?php 
                    $created_at = strtotime($reply['created_at']); 
                    echo date('F j, Y, H:i', $created_at);
                ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<a id="collase-<?= $id ?>" onclick="collase_reply(<?= $id . ',' . $num_replies ?>)">Thu nhỏ</a>