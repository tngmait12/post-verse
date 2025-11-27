<?php
    session_start();
    include('admin/config/dbcon.php');

    $filter = $_GET['filter'] ?? 'date';
    $arrange = $_GET['arrange'] ?? 'desc';
    $search = $_GET['q'] ?? '';
    $fromDate = $_GET['from_date'] ?? null;
    $toDate   = $_GET['to_date'] ?? null;

    $search_param = "%$search%";

    $sql = "SELECT 
        p.id,
        p.name, 
        p.slug, 
        p.description, 
        p.created_at, 
        p.image, 
        CONCAT(u.fname, ' ', u.lname) AS author,
        c.name AS category_name,
        COUNT(DISTINCT r.user_id) AS likes_count,
        COUNT(DISTINCT cmt.id) AS comments_count
    FROM posts p
    JOIN users u ON p.user_id = u.id
    JOIN categories c ON p.category_id = c.id
    LEFT JOIN post_reactions r ON p.id = r.source_id
    LEFT JOIN comments cmt ON p.id = cmt.post_id
    WHERE (p.name LIKE ? 
        OR p.description LIKE ? 
        OR p.meta_title LIKE ? 
        OR CONCAT(u.fname, ' ', u.lname) LIKE ? 
        OR c.name LIKE ?)
    AND p.status = 1";

    $params = [$search_param, $search_param, $search_param, $search_param, $search_param];
    $types = "sssss";

    if ($fromDate && $toDate) {
        $sql .= " AND p.created_at BETWEEN ? AND ?";
        $params[] = $fromDate;
        $params[] = $toDate;
        $types .= "ss";
    }

    $sql .= " GROUP BY p.id";

    $order_column = 'p.created_at';
    switch ($filter) {
        case 'reaction':
            $order_column = 'likes_count';
            break;
        case 'comment':
            $order_column = 'comments_count';
            break;
        case 'date':
        default:
            $order_column = 'p.created_at';
            break;
    }

    $order_dir = ($arrange === 'desc') ? 'DESC' : 'ASC';
    $sql .= " ORDER BY $order_column $order_dir";

    $stmt = $con->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    include("includes/header.php");
?>

<div class="container mt-4">
    <form method="get" class="d-block d-lg-flex align-items-center">
        <input type="hidden" name="q" value="<?= htmlspecialchars($search) ?>">  
        <div class="mx-2 d-block d-lg-flex form-group align-items-center">
            <label class="form-label" for="filter" label="filter">Lọc theo: </label>
            <select class="form-control" id="filter" name="filter" onchange="this.form.submit()">
                <option value="reaction" <?= ($filter === "reaction" ? 'selected' : '') ?>>Tương tác</option>
                <option value="comment" <?= ($filter === "comment" ? 'selected' : '') ?>>Bình luận</option>
                <option value="date" <?= ($filter === "date" ? "selected" : "") ?>>Ngày đăng</option>
            </select>
        </div>

        <div class="mx-2 d-block d-lg-flex form-group align-items-center">
            <label class="form-label" for="arrange">Sắp xếp: </label>
            <select class="form-control" id="arrange" name="arrange" onchange="this.form.submit()">
                <option value="desc" <?= ($arrange === 'desc' ? 'selected' : '') ?>>Giảm dần</option>
                <option value="asc" <?= ($arrange === 'asc' ? 'selected' : '') ?>>Tăng dần</option>
            </select>
        </div>

        <div class="mx-2 d-block d-lg-flex form-group align-items-center">
            <label class="form-label" for="from_date">Từ ngày: </label>
            <input class="form-control" type="date" id="from_date" name="from_date" value="<?= htmlspecialchars($fromDate ?? '') ?>">
        </div>

        <div class="mx-2 d-block d-lg-flex form-group align-items-center">
            <label class="form-label" for="to_date">Đến ngày: </label>
            <input class="form-control" type="date" id="to_date" name="to_date" value="<?= htmlspecialchars($toDate ?? '') ?>">
        </div>

        <div class="mx-2 d-block d-lg-flex form-group">
            <button class="btn-info form-control" type="submit"> Lọc </button>
        </div>
    </form>
    
    <h3>Kết quả cho: <b><?= htmlspecialchars($search) ?></b></h3>

    <hr>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="result-item mb-3 row">
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <img src="uploads/posts/<?= $row['image'] ?>" alt="" style="height: 150px;">
                </div>
                <div class="col-8">
                    <h4><a href="single-blog.php?slug=<?= htmlspecialchars($row['slug']) ?>"><?= htmlspecialchars($row['name']) ?></a></h4>
                    <p><?= substr(strip_tags($row['description']), 0, 120) ?>...</p>
                    <div class="blog-post-meta">
                    <ul>
                        <li>By <a href="about.html"><?= $row['author'] ?></a></li>
                        <li>
                            <i class="fa fa-clock-o"></i>
                            <?php 
                                $created_at = strtotime($row['created_at']); 
                                echo date('F j, Y, H:i', $created_at);
                            ?>
                        </li>
                    </ul>
                </div>
                    <div class="small text-muted">
                        👍 <?= $row['likes_count'] ?> — 💬 <?= $row['comments_count'] ?>
                    </div>
                </div>
            </div>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Không tìm thấy kết quả.</p>
    <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>