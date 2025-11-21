<?php
// BẢO MẬT & TÍNH NĂNG ĐƯỢC CẢI THIỆN (Sử dụng Prepared Statements và LEFT JOIN)

include __DIR__ . "/admin/config/dbcon.php";

// Lấy từ khóa và chuẩn bị cho Prepared Statement
$q = isset($_GET['q']) ? $_GET['q'] : "";
// Tạo pattern tìm kiếm %keyword%
$search_param = "%" . $q . "%"; 

// Bộ lọc/sắp xếp
$sort = isset($_GET['sort']) ? $_GET['sort'] : "newest";

// Thứ tự sắp xếp (Sử dụng alias p.created_at để chỉ định rõ)
switch ($sort) {
    case "like":
        // Sắp xếp theo lượt thích, sau đó theo ngày tạo mới nhất
        $order = "ORDER BY likes_count DESC, p.created_at DESC";
        break;

    case "comment":
        // Sắp xếp theo bình luận, sau đó theo ngày tạo mới nhất
        $order = "ORDER BY comments_count DESC, p.created_at DESC";
        break;

    case "oldest":
        $order = "ORDER BY p.created_at ASC";
        break;

    default: // newest
        $order = "ORDER BY p.created_at DESC";
        break;
}

// Query chính:
// 1. SELECT các cột cần thiết (name, description) + SLUG để liên kết.
// 2. LEFT JOIN comments để COUNT số bình luận.
// 3. LEFT JOIN post_reactions để COUNT số lượt thích (reaction = 'like').
$sql = "
    SELECT
        p.id, p.name, p.description, p.created_at, p.slug, -- Thêm p.slug để dùng cho liên kết
        COUNT(DISTINCT c.id) AS comments_count,
        COUNT(CASE WHEN pr.reaction = 'like' THEN 1 ELSE NULL END) AS likes_count
    FROM
        posts p
    LEFT JOIN
        comments c ON p.id = c.post_id
    LEFT JOIN
        post_reactions pr ON p.id = pr.source_id
    WHERE
        p.name LIKE ? -- Dùng tên cột đúng
        OR p.description LIKE ? -- Dùng tên cột đúng
        OR p.meta_keyword LIKE ? -- Dùng tên cột đúng
    GROUP BY
        p.id, p.name, p.description, p.created_at, p.slug
    $order
";

// BẮT ĐẦU SỬ DỤNG PREPARED STATEMENT
$stmt = mysqli_prepare($con, $sql);

// Kiểm tra lỗi Prepared Statement
if ($stmt === false) {
    die("<h3 style='color:red'>Prepared Statement Error:</h3>" . mysqli_error($con));
}

// Bind 3 tham số ('s' cho string) cho 3 dấu '?'
mysqli_stmt_bind_param($stmt, 'sss', $search_param, $search_param, $search_param); 

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Debug SQL nếu lỗi
if (!$result) {
    die("<h3 style='color:red'>SQL Error:</h3>" . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-4">

    <h3>Kết quả cho: <b><?= htmlspecialchars($q) ?></b></h3>

    <form method="GET" class="mb-3">
        <input type="hidden" name="q" value="<?= htmlspecialchars($q) ?>">

        <label>Sắp xếp theo:</label>
        <select name="sort" onchange="this.form.submit()">
            <option value="newest" <?= ($sort == "newest" ? "selected" : "") ?>>Mới nhất</option>
            <option value="oldest" <?= ($sort == "oldest" ? "selected" : "") ?>>Cũ nhất</option>
            <option value="like"    <?= ($sort == "like" ? "selected" : "") ?>>Nhiều lượt thích</option>
            <option value="comment" <?= ($sort == "comment" ? "selected" : "") ?>>Nhiều bình luận</option>
        </select>
    </form>

    <hr>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="result-item mb-3">
                <h4><a href="single-blog.php?slug=<?= htmlspecialchars($row['slug']) ?>"><?= htmlspecialchars($row['name']) ?></a></h4>
                <p><?= substr(strip_tags($row['description']), 0, 120) ?>...</p>
                <div class="small text-muted">
                    ❤️ <?= $row['likes_count'] ?> — 💬 <?= $row['comments_count'] ?> — <?= $row['created_at'] ?>
                </div>
                <hr>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Không tìm thấy kết quả.</p>
    <?php endif; ?>

</div>

</body>
</html>