<?php
    include("../admin/config/dbcon.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT c.*, u.fname, u.lname,
                    ( SELECT COUNT(*) FROM comments AS child WHERE child.parent_id = c.id ) AS sub_cmt
                    FROM comments AS c
                    JOIN users AS u ON c.user_id = u.id 
                    WHERE c.post_id = ?
                    ORDER BY c.created_at DESC";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
?>

<?php while ($cmt = mysqli_fetch_assoc($result)): ?>
    <?php if ($cmt['parent_id'] == null): ?>
        <div class="comment-field mt-3">
            <div class="comment-box">
                <div class="name-field">
                    <?= $cmt['fname'] . " " . $cmt['lname'] ?>
                </div>
                <div class="content-field">
                    <?= $cmt['content'] ?>
                </div>
                <div style="color: #1877F2;">
                    <i class="fa fa-clock-o pl-2"></i>
                    <?php 
                        $created_at = strtotime($cmt['created_at']); 
                        echo date('F j, Y, H:i', $created_at);
                    ?>
                </div>
            </div>
            <?php if ($cmt['sub_cmt'] > 0): ?>
                <div id="replies-<?= $cmt['id'] ?>" class="reply-section ml-3">
                    <a id="expand-<?= $cmt['id'] ?>" onclick="expand_reply(<?= $cmt['id'] ?>)">Mở rộng - <?= $cmt['sub_cmt'] ?> bình luận</a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endwhile; ?>