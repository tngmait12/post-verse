<?php
include('authentication.php');
include('includes/header.php');

// Đếm tổng số Categories
$query_categories = "SELECT * FROM categories WHERE status != '2'";
$query_categories_run = mysqli_query($con, $query_categories);
$total_categories = mysqli_num_rows($query_categories_run);

// Đếm tổng số Posts
$query_posts = "SELECT * FROM posts WHERE status != '2'";
$query_posts_run = mysqli_query($con, $query_posts);
$total_posts = mysqli_num_rows($query_posts_run);

// Đếm tổng số Users
$query_users = "SELECT * FROM users WHERE role_as = '0' AND status != '2'";
$query_users_run = mysqli_query($con, $query_users);
$total_users = mysqli_num_rows($query_users_run);

// Đếm tổng số Admins
$query_admins = "SELECT * FROM users WHERE role_as IN ('1','2') AND status != '2'";
$query_admins_run = mysqli_query($con, $query_admins);
$total_admins = mysqli_num_rows($query_admins_run);

// Thống kê bài viết hàng ngày (7 ngày gần nhất)
$post_dates = [];
$post_counts = [];
$total_posts_week = 0;
$start_date = date('Y-m-d', strtotime('-6 days'));
$end_date = date('Y-m-d');

$query_daily_posts = "SELECT DATE(created_at) as post_date, COUNT(id) as post_count 
                      FROM posts 
                      WHERE created_at >= '$start_date' AND created_at <= '$end_date 23:59:59'
                      GROUP BY DATE(created_at)
                      ORDER BY post_date ASC";
$query_daily_posts_run = mysqli_query($con, $query_daily_posts);

while($row = mysqli_fetch_assoc($query_daily_posts_run)) {
    $post_dates[] = date('M d', strtotime($row['post_date']));
    $post_counts[] = $row['post_count'];
    $total_posts_week += $row['post_count'];
}
?>

<div class="container">
    <?php include('../message.php') ?>
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <a href="view-categories.php" class="col-icon">
                                <div
                                    class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                            </a>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Categories</p>
                                    <h4 class="card-title"><?= $total_categories; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <a href="view-posts.php" class="col-icon">
                                <div
                                    class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="far fa-newspaper"></i>
                                </div>
                            </a>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Posts</p>
                                    <h4 class="card-title"><?= $total_posts; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <a href="view-register.php" class="col-icon">
                                <div
                                    class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </a>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Users</p>
                                    <h4 class="card-title"><?= $total_users; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <a href="view-register.php" class="col-icon">
                                <div
                                    class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                            </a>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Admins</p>
                                    <h4 class="card-title"><?= $total_admins; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daily Posts</div>
                        </div>
                        <div class="card-category"><?= date('M d', strtotime($start_date)) . ' - ' . date('M d', strtotime($end_date)) ?></div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1><?= $total_posts_week ?> Posts</h1>
                        </div>
                        <div class="pull-in">
                            <canvas id="dailyPostsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">Users Geolocation</h4>
                            <div class="card-tools">
                                <button
                                    class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button
                                    class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                    <span class="fa fa-sync-alt"></span>
                                </button>
                                <button
                                    class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        </div>
                        <p class="card-category">
                            Map of the distribution of users around the world
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img
                                                            src="assets/img/flags/id.png"
                                                            alt="indonesia" />
                                                    </div>
                                                </td>
                                                <td>Indonesia</td>
                                                <td class="text-end">2.320</td>
                                                <td class="text-end">42.18%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img
                                                            src="assets/img/flags/us.png"
                                                            alt="united states" />
                                                    </div>
                                                </td>
                                                <td>USA</td>
                                                <td class="text-end">240</td>
                                                <td class="text-end">4.36%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img
                                                            src="assets/img/flags/au.png"
                                                            alt="australia" />
                                                    </div>
                                                </td>
                                                <td>Australia</td>
                                                <td class="text-end">119</td>
                                                <td class="text-end">2.16%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img
                                                            src="assets/img/flags/ru.png"
                                                            alt="russia" />
                                                    </div>
                                                </td>
                                                <td>Russia</td>
                                                <td class="text-end">1.081</td>
                                                <td class="text-end">19.65%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img
                                                            src="assets/img/flags/cn.png"
                                                            alt="china" />
                                                    </div>
                                                </td>
                                                <td>China</td>
                                                <td class="text-end">1.100</td>
                                                <td class="text-end">20%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img
                                                            src="assets/img/flags/br.png"
                                                            alt="brazil" />
                                                    </div>
                                                </td>
                                                <td>Brasil</td>
                                                <td class="text-end">640</td>
                                                <td class="text-end">11.63%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mapcontainer">
                                    <div
                                        id="world-map"
                                        class="w-100"
                                        style="height: 300px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">New Customers</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-icon btn-clean me-0"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div
                                        class="dropdown-menu"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-list py-4">
                            <div class="item-list">
                                <div class="avatar">
                                    <img
                                        src="assets/img/jm_denis.jpg"
                                        alt="..."
                                        class="avatar-img rounded-circle" />
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Jimmy Denis</div>
                                    <div class="status">Graphic Designer</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <span
                                        class="avatar-title rounded-circle border border-white">CF</span>
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Chandra Felix</div>
                                    <div class="status">Sales Promotion</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img
                                        src="assets/img/talha.jpg"
                                        alt="..."
                                        class="avatar-img rounded-circle" />
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Talha</div>
                                    <div class="status">Front End Designer</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img
                                        src="assets/img/chadengle.jpg"
                                        alt="..."
                                        class="avatar-img rounded-circle" />
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Chad</div>
                                    <div class="status">CEO Zeleaf</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <span
                                        class="avatar-title rounded-circle border border-white bg-primary">H</span>
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Hizrian</div>
                                    <div class="status">Web Designer</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <span
                                        class="avatar-title rounded-circle border border-white bg-secondary">F</span>
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Farrah</div>
                                    <div class="status">Marketing</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Transaction History</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-icon btn-clean me-0"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div
                                        class="dropdown-menu"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Payment Number</th>
                                        <th scope="col" class="text-end">Date & Time</th>
                                        <th scope="col" class="text-end">Amount</th>
                                        <th scope="col" class="text-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>
<script src="assets/js/core/jquery-3.7.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="assets/js/plugin/chart.js/chart.min.js"></script>

<!-- Kaiadmin JS -->
<script src="assets/js/kaiadmin.min.js"></script>

<!-- Custom JS for Chart -->
<script>
$(document).ready(function() {
    var dailyPostsChart = document.getElementById('dailyPostsChart').getContext('2d');

    var myDailyPostsChart = new Chart(dailyPostsChart, {
        type: 'line',
        data: {
            labels: <?= json_encode($post_dates); ?>,
            datasets:[ {
                label: "Daily Posts", 
                fill: true, 
                backgroundColor: "rgba(255,255,255,0.2)", 
                borderColor: "#fff", 
                borderCapStyle: "butt", 
                borderDash: [], 
                borderDashOffset: 0, 
                pointBorderColor: "#fff", 
                pointBackgroundColor: "#fff", 
                pointBorderWidth: 1, 
                pointHoverRadius: 5, 
                pointHoverBackgroundColor: "#fff", 
                pointHoverBorderColor: "#fff", 
                pointHoverBorderWidth: 1, 
                pointRadius: 1, 
                pointHitRadius: 5, 
                data: <?= json_encode($post_counts); ?>
            }]
        },
        options : {
            maintainAspectRatio: false, 
            legend: { display: false }, 
            animation: { easing: "easeInOutBack" }, 
            scales: { yAxes:[{ display:false }], xAxes:[{ display:false }] }
        }
    });
});
</script>
</body>
</html>