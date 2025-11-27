<?php
define('LIMIT_TRENDING', 5);

$query = "SELECT 
        p.id,
        p.name,
        p.image,
        p.slug,
        p.created_at,
        COUNT(pr.reaction) AS reaction_count
    FROM posts p
    LEFT JOIN post_reactions pr ON pr.source_id = p.id
    WHERE p.status = 1
    GROUP BY p.id, p.meta_description, p.image, p.slug, p.created_at
    ORDER BY reaction_count DESC
    LIMIT " . LIMIT_TRENDING;

$result = mysqli_fetch_all(mysqli_execute_query($con, $query), MYSQLI_ASSOC);
?>

<div class="col-lg-4">
    <div class="blog-post-widget">
        <div class="latest-widget-title">
            <h2>Trending post</h2>
        </div>
        <?php foreach ($result as $row): ?>
            <div class="latest-widget">
                <div class="latest-widget-thum">
                    <a href="single-blog.html">
                        <?php
                        $image_source = !empty($row['image'])
                            ? "uploads/posts/" . $row['image']
                            : "uploads/imgs/post.png";
                        ?>
                        <img src="<?= $image_source ?>" alt="blog-thum" />
                    <div class="icon">
                        <a><img src="images/blog/icon.svg" alt="icon" /></a>
                    </div>
                </div>
                <div class="latest-widget-content">
                    <div class="content-title">
                        <a href="single-blog.php?slug=<?= $row['slug'] ?>"><?= $row['name'] ?></a>
                    </div>
                    <div class="content-meta">
                        <ul>
                            <li>
                                <i class="fa fa-clock-o"></i>
                                <?php
                                $created_at = strtotime($row['created_at']);
                                echo date('F j, Y, H:i', $created_at);
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>