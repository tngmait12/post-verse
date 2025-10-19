<?php
    include('../admin/config/dbcon.php');

    $query = "SELECT c.*, u.lname, u.fname, r.lname AS r_lname, r.fname AS r_fname
                FROM comments AS c 
                JOIN users AS u ON c.user_id = u.id
                JOIN users AS r ON r.id = (SELECT user_id FROM comments WHERE id = c.reply)
                WHERE c.parent_id = ?
                ORDER BY c.created_at ASC";

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
                <?= $reply['fname'] . ' ' . $reply['lname'] ?>
                <i class="bi bi-caret-right-fill"></i>
                <?= $reply['r_fname'] . ' ' . $reply['r_lname'] ?>
            </div>
            <div class="content-field"><?= $reply['content'] ?>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                    <div class="" style="color: #1877F2; font-size: smaller;">
                        <i class="fa fa-clock-o"></i>
                        <?php 
                            $created_at = strtotime($reply['created_at']); 
                            echo date('F j, Y, H:i', $created_at);
                        ?>
                    </div>
                    <div class="">
                        <a onclick="replyCmt(<?= $reply['id']?>, '<?= $reply['fname'] . ' ' . $reply['lname'] ?>')" role="button" class="" style="cursor: pointer;">reply</a>
                        <a class=" text-primary">
                            <p class="d-inline ml-2">12</p> <i class=" bi bi-hand-thumbs-up-fill"></i>
                        </a>
                        <a class=" text-danger">
                            <p class="d-inline ml-2">12</p> <i class="bi bi-hand-thumbs-down-fill"></i>
                        </a>
                    </div>
                </div>
        </div>
    <?php endwhile; ?>
</div>
<a id="collase-<?= $id ?>" onclick="collase_reply(<?= $id . ',' . $num_replies ?>)">Thu nhỏ</a>