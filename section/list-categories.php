<?php   
    $query = "SELECT c.id, c.name, c.slug, 
        (SELECT COUNT(*) FROM posts p WHERE p.category_id = c.id AND status = 1) AS count
        FROM categories c 
        WHERE c.status = 1";
    // 0 la visible 

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);   
?>

<div class="col-lg-4">
    <div class="blog-post-widget">
        <div class="latest-widget-title">
            <h2>List categories</h2>
        </div>
        <div style="display: block; overflow-x: hidden; overflow-y: auto; height: 300px;">
            <hr>
            <?php foreach ($categories as $row): ?>
                <div>
                    <a href="category.php?slug=<?= $row['slug'] ?>" style="text-decoration: none;">
                        <h6><?= $row['name'] ?> - <p style="display: inline;"><?= $row['count'] ?> bài viết</p></h6>
                        <hr>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>