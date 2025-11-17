<?php
    $query = "SELECT 
        p.id, 
        p.meta_description,
        p.image,
        p.slug,
        p.created_at,
        COUNT(CASE WHEN pr.reaction = 'like' THEN 1 END) AS like_count,
        COUNT(CASE WHEN pr.reaction = 'dislike' THEN 1 END) AS dislike_count
    FROM posts p
    LEFT JOIN post_reactions pr ON p.id = pr.source_id
    GROUP BY p.id, p.meta_description, p.image, p.slug, p.created_at
    ORDER BY 
        CASE 
            WHEN COUNT(CASE WHEN pr.reaction = 'dislike' THEN 1 END) = 0 THEN 1
            ELSE 0
        END,
        ROUND(
            COUNT(CASE WHEN pr.reaction = 'like' THEN 1 END) * 1.0 / 
            NULLIF(COUNT(CASE WHEN pr.reaction = 'dislike' THEN 1 END), 0), 2
        ) DESC
    LIMIT 4;";

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
                    <img src="uploads/posts/<?= $row['image'] ?>" alt="blog-thum" /></a>
                    <div class="icon">
                        <a><img src="images/blog/icon.svg" alt="icon" /></a>
                    </div>
            </div>
            <div class="latest-widget-content">
                <div class="content-title">
                    <a href="single-blog.php?slug=<?= $row['slug'] ?>"><?= $row['meta_description'] ?></a>
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