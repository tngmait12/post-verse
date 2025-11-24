<?php


include __DIR__ . "/admin/config/dbcon.php";

// --- 1. LẤY & CHUẨN BỊ CÁC THAM SỐ TỪ URL ---

// a. Tìm kiếm
$q = isset($_GET['q']) ? $_GET['q'] : "";
$search_param = "%" . $q . "%"; 

// b. 3 Bộ lọc Sắp xếp Riêng biệt
// Mặc định là 'newest' (Mới nhất)
$sort_date = isset($_GET['sort_date']) ? $_GET['sort_date'] : "newest"; 
$sort_like = isset($_GET['sort_like']) ? $_GET['sort_like'] : ""; // Mặc định rỗng
$sort_comment = isset($_GET['sort_comment']) ? $_GET['sort_comment'] : ""; // Mặc định rỗng

// c. Bộ lọc theo ngày (Giữ nguyên)
$from_date = isset($_GET['from_date']) && !empty($_GET['from_date']) ? $_GET['from_date'] : null;
$to_date = isset($_GET['to_date']) && !empty($_GET['to_date']) ? $_GET['to_date'] : null;

$to_date_param = null;
if ($to_date) {
    $to_date_param = $to_date . " 23:59:59";
}

// --- 2. XÂY DỰNG ĐIỀU KIỆN ORDER BY CHÍNH ---

$order_by_main = "";
$order_by_fallback = "";

// ƯU TIÊN 1: Sắp xếp theo Bình luận
if ($sort_comment == "most_comment") {
    $order_by_main = "comments_count DESC";
} elseif ($sort_comment == "least_comment") {
    $order_by_main = "comments_count ASC";
} 
// ƯU TIÊN 2: Sắp xếp theo Lượt thích (Chỉ xem xét nếu không chọn Bình luận)
elseif ($sort_like == "most_like") {
    $order_by_main = "likes_count DESC";
} elseif ($sort_like == "least_like") {
    $order_by_main = "likes_count ASC";
} 
// ƯU TIÊN 3: Sắp xếp theo Ngày tạo (Nếu không có tiêu chí nào khác)
elseif ($sort_date == "oldest") {
    $order_by_main = "p.created_at ASC";
} else {
    // Mặc định hoặc 'newest'
    $order_by_main = "p.created_at DESC";
}

// Luôn dùng created_at làm tiêu chí phụ để đảm bảo thứ tự ổn định
$order = "ORDER BY {$order_by_main}, p.created_at DESC"; 

// --- 3. XÂY DỰNG QUERY SQL VÀ ĐIỀU KIỆN WHERE ĐỘNG (Giữ nguyên) ---

$where_clauses = []; 
$bind_types = '';    
$bind_params = [];   

// a. Điều kiện Tìm kiếm (Luôn có - 3 tham số string)
$where_clauses[] = "(p.name LIKE ? OR p.description LIKE ? OR p.meta_keyword LIKE ?)";
$bind_types .= 'sss';
$bind_params[] = $search_param;
$bind_params[] = $search_param;
$bind_params[] = $search_param;

// b. Bộ lọc theo ngày BẮT ĐẦU 
if ($from_date) {
    $where_clauses[] = "p.created_at >= ?"; 
    $bind_types .= 's'; 
    $bind_params[] = $from_date;
}

// c. Bộ lọc theo ngày KẾT THÚC 
if ($to_date_param) {
    $where_clauses[] = "p.created_at <= ?";
    $bind_types .= 's'; 
    $bind_params[] = $to_date_param;
}

$where_sql = count($where_clauses) > 0 ? "WHERE " . implode(" AND ", $where_clauses) : "";


// Query chính:
$sql = "
    SELECT
        p.id, p.name, p.description, p.created_at, p.slug, 
        COUNT(DISTINCT c.id) AS comments_count,
        COUNT(CASE WHEN pr.reaction = 'like' THEN 1 ELSE NULL END) AS likes_count
    FROM
        posts p
    LEFT JOIN
        comments c ON p.id = c.post_id
    LEFT JOIN
        post_reactions pr ON p.id = pr.source_id
    {$where_sql}
    GROUP BY
        p.id, p.name, p.description, p.created_at, p.slug
    {$order}
";

// BẮT ĐẦU SỬ DỤNG PREPARED STATEMENT
$stmt = mysqli_prepare($con, $sql);

if ($stmt === false) {
    die("<h3 style='color:red'>Prepared Statement Error:</h3>" . mysqli_error($con));
}

// --- 4. BIND THAM SỐ ĐỘNG (Giữ nguyên) ---
if (!empty($bind_params)) {
    array_unshift($bind_params, $bind_types);

    $refs = [];
    foreach($bind_params as $key => $value) {
        $refs[$key] = &$bind_params[$key]; 
    }

    call_user_func_array([$stmt, 'bind_param'], $refs);
}


mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("<h3 style='color:red'>SQL Error:</h3>" . mysqli_error($con));
}
include(__DIR__ . "/includes/header.php"); // Include Header
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .filter-row {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 15px; /* Khoảng cách giữa các bộ lọc */
        }
        .filter-row > div {
            margin-bottom: 10px;
        }
        .filter-row label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <h3>Kết quả cho: <b><?= htmlspecialchars($q) ?></b></h3>

    <form method="GET" class="mb-3">
        <input type="hidden" name="q" value="<?= htmlspecialchars($q) ?>">
        
        <div class="filter-row">
            
            <div>
                <label>Theo Ngày:</label>
                <select name="sort_date" onchange="this.form.submit()">
                    <option value="newest" <?= ($sort_date == "newest" ? "selected" : "") ?>>Mới nhất</option>
                    <option value="oldest" <?= ($sort_date == "oldest" ? "selected" : "") ?>>Cũ nhất</option>
                </select>
            </div>

            <div>
                <label>Theo Lượt thích:</label>
                <select name="sort_like" onchange="this.form.submit()">
                    <option value="" <?= ($sort_like == "" ? "selected" : "") ?>>--- Không chọn ---</option>
                    <option value="most_like" <?= ($sort_like == "most_like" ? "selected" : "") ?>>Nhiều nhất</option>
                    <option value="least_like" <?= ($sort_like == "least_like" ? "selected" : "") ?>>Ít nhất</option>
                </select>
            </div>

            <div>
                <label>Theo Bình luận:</label>
                <select name="sort_comment" onchange="this.form.submit()">
                    <option value="" <?= ($sort_comment == "" ? "selected" : "") ?>>--- Không chọn ---</option>
                    <option value="most_comment" <?= ($sort_comment == "most_comment" ? "selected" : "") ?>>Nhiều nhất</option>
                    <option value="least_comment" <?= ($sort_comment == "least_comment" ? "selected" : "") ?>>Ít nhất</option>
                </select>
            </div>

            <div>
                <label for="from_date">Thời gian từ ngày:</label>
                <input type="date" id="from_date" name="from_date" value="<?= htmlspecialchars($from_date ?? '') ?>">
            </div>

            <div>
                <label for="to_date">Đến ngày:</label>
                <input type="date" id="to_date" name="to_date" value="<?= htmlspecialchars($to_date ?? '') ?>">
            </div>

            <div>
                <button type="submit">Lọc</button>
            </div>
        </div>
    </form>

    <hr>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="result-item mb-3">
                <h4><a href="single-blog.php?slug=<?= htmlspecialchars($row['slug']) ?>"><?= htmlspecialchars($row['name']) ?></a></h4>
                <p><?= substr(strip_tags($row['description']), 0, 120) ?>...</p>
                <div class="small text-muted">
                    👍 <?= $row['likes_count'] ?> — 💬 <?= $row['comments_count'] ?> — <?= $row['created_at'] ?>
                </div>
                <hr>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Không tìm thấy kết quả.</p>
    <?php endif; ?>
    <?php 
include(__DIR__ . "/includes/footer.php"); // Include Footer
?>
</div>

</body>
</html>
