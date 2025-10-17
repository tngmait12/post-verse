<?php
    $page = $_GET["page"] ?? 1;

    define('POSTS_IN_PAGE', 3);

    $count_post = "SELECT COUNT(*) AS count FROM posts WHERE status = 0";
    $count = (int)mysqli_query($con, $count_post)->fetch_assoc()['count'];

    $pagination = ceil($count / POSTS_IN_PAGE);

    $query = 'SELECT p.*, u.fname, u.lname 
        FROM posts AS p 
        JOIN users AS u ON p.user_id = u.id 
        WHERE p.status = 0
        LIMIT ' . POSTS_IN_PAGE . ' 
        OFFSET ' . (($page - 1) * POSTS_IN_PAGE);

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $count_post = count($rows_result);
?>

<?php if (count($rows_result) > 0): ?>
    <?php foreach ($rows_result as $row): ?>
        <article class="blog-post">
            <div class="blog-post-thumb">
                <img src="uploads/posts/<?= $row['image'] ?>" alt="blog-thum" />
            </div>
            <div class="blog-post-content">
                <div class="blog-post-tag">
                    <a href="category.html">Travel</a>
                </div>
                <div class="blog-post-title">
                    <a href="single-blog.php?slug=<?php echo $row['slug'] ?>">
                        <?php echo $row['name'] ?>
                    </a>
                </div>
                <div class="blog-post-meta">
                    <ul>
                        <li>By <a href="about.html"><?= $row['lname'] . ' ' . $row['fname'] ?></a></li>
                        <li>
                            <i class="fa fa-clock-o"></i>
                            <?php 
                                $created_at = strtotime($row['created_at']); 
                                echo date('F j, Y, H:i', $created_at);
                            ?>
                        </li>
                    </ul>
                </div>
                <p>
                    <?= $row['meta_description'] ?>
                </p>
                <a href="single-blog.php?slug=<?php echo $row['slug'] ?>" class="blog-post-action">read more <i class="fa fa-angle-right"></i></a>
            </div>
        </article>
    <?php endforeach; ?>

    <div class="blog-post-pagination">
        <nav aria-label="Page navigation example" class="nav-bg">
            <ul class="pagination">
                <?php if ($pagination > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?= 1 ?>">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $pagination; $i++): ?>
                        <li class="page-item"><a class="page-link <?php if ($i == $page) echo "active"; ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?= $pagination ?>">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
<?php else: ?>
    <h2>Không có bài viết nào</h2>
<?php endif; ?>