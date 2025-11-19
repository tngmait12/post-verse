<?php
  define('LIMIT_FEATURED', 1);

  $query = "SELECT 
    p.id, 
    p.name,
    p.image,
    p.slug,
    p.created_at,
    u.lname,
    u.fname,
    u.image AS avata,
    COUNT(CASE WHEN pr.reaction = 'like' THEN 1 END) AS like_count,
    COUNT(CASE WHEN pr.reaction = 'dislike' THEN 1 END) AS dislike_count
    FROM posts p
    LEFT JOIN post_reactions pr ON p.id = pr.source_id
    JOIN users u ON p.user_id = u.id
    GROUP BY p.id, p.name, p.image, p.slug, p.created_at
    ORDER BY 
        CASE 
            WHEN COUNT(CASE WHEN pr.reaction = 'dislike' THEN 1 END) = 0 THEN 1
            ELSE 0
        END,
        ROUND(
            COUNT(CASE WHEN pr.reaction = 'like' THEN 1 END) * 1.0 / 
            NULLIF(COUNT(CASE WHEN pr.reaction = 'dislike' THEN 1 END), 0), 2
        ) DESC
    LIMIT " . LIMIT_FEATURED;

  $result = mysqli_fetch_assoc(mysqli_execute_query($con, $query));
?>

<section class="featured">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <article class="featured-post row">
          <div class="featured-post-content col-lg-7 col-12">
            <div class="featured-post-author">
              <img src="uploads/users/<?= $result['avata'] ?>" alt="author" />
              <p>By <span><?= $result['fname'] . ' ' . $result['lname'] ?></span></p>
            </div>
            <a href="single-blog.php?slug=<?php echo $result['slug'] ?>" class="featured-post-title" 
              style="
                font-size: 2em;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;"
            >
              <?= $result['name'] ?>
            </a>
            <ul class="featured-post-meta">
              <li>
                <i class="fa fa-clock-o"></i>
                <?php 
                    $created_at = strtotime($result['created_at']); 
                    echo date('F j, Y, H:i', $created_at);
                ?>
              </li>
            </ul>
          </div>
          <div class="featured-post-thumb col-lg-5 col-12">
            <img src="uploads/posts/<?= $result['image'] ?>" alt="feature-post-thumb" width="100%" />
          </div>
        </article>
      </div>
    </div>
  </div>
</section>