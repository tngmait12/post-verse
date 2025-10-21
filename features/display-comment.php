<?php
    $source_reaction = 'comment_reactions';

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
        <?php $reaction_id = $cmt['id']; ?>
        <div class="comment-field mt-3">
            <div class="comment-box">
                <div class="name-field">
                    <?= $cmt['fname'] . " " . $cmt['lname'] ?>
                </div>
                <div class="content-field"><?= $cmt['content'] ?>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="" style="color: #1877F2; font-size: smaller;">
                        <i class="fa fa-clock-o"></i>
                        <?php 
                            $created_at = strtotime($cmt['created_at']); 
                            echo date('F j, Y, H:i', $created_at);
                        ?>
                    </div>
                    <div>
                        <a onclick="replyCmt(<?= $cmt['id']?>, '<?= $cmt['fname'] . ' ' . $cmt['lname'] ?>')" role="button" class="" style="cursor: pointer;">reply</a>
                        <?php include('reaction.php'); ?>
                    </div>
                </div>
            </div>
            <div id="replies-<?= $cmt['id'] ?>" class="reply-section ml-3">
                <?php if ($cmt['sub_cmt'] > 0): ?>
                    <a id="expand-<?= $cmt['id'] ?>" onclick="expand_reply(<?= $cmt['id'] ?>)">Mở rộng - <?= $cmt['sub_cmt'] ?> bình luận</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endwhile; ?>