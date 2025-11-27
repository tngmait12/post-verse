<?php
include('code-superadmin.php');
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

// Thống kê bài viết theo thời gian
$post_dates = [];
$post_counts = [];
$total_posts_period = 0;

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
} else {
    $start_date = date('Y-m-d', strtotime('-6 days'));
    $end_date = date('Y-m-d');
}

$query_daily_posts = "SELECT DATE(created_at) as post_date, COUNT(id) as post_count 
                      FROM posts 
                      WHERE created_at >= '$start_date' AND created_at <= '$end_date 23:59:59'
                      GROUP BY DATE(created_at)
                      ORDER BY post_date ASC";
$query_daily_posts_run = mysqli_query($con, $query_daily_posts);

while ($row = mysqli_fetch_assoc($query_daily_posts_run)) {
    $post_dates[] = date('M d', strtotime($row['post_date']));
    $post_counts[] = $row['post_count'];
    $total_posts_period += $row['post_count'];
}
?>

<div class="container">
    <?php include('../message.php') ?>
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
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
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
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
                                <div class="icon-big text-center icon-info bubble-shadow-small">
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
                                <div class="icon-big text-center icon-success bubble-shadow-small">
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
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
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
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">Post Statistics</div>
                            <form action="" method="GET" class="d-flex align-items-center">
                                <div class="input-group input-group-sm">
                                    <input type="date" name="start_date" value="<?= $start_date ?>" class="form-control"
                                        required>
                                    <span class="input-group-text">to</span>
                                    <input type="date" name="end_date" value="<?= $end_date ?>" class="form-control"
                                        required>
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-category">
                            <?= date('M d, Y', strtotime($start_date)) . ' - ' . date('M d, Y', strtotime($end_date)) ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/script.php');
include('includes/footer.php');
?>

<script>
    $(document).ready(function () {
        // Statistics Chart
        var ctx = document.getElementById('statisticsChart').getContext('2d');
        var statisticsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($post_dates); ?>,
                datasets: [{
                    label: "Posts",
                    borderColor: '#177dff',
                    backgroundColor: '#177dff',
                    borderWidth: 2,
                    data: <?= json_encode($post_counts); ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: { left: 5, right: 5, top: 15, bottom: 15 }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontStyle: "500",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                },
                legendCallback: function (chart) {
                    var text = [];
                    text.push('<ul class="' + chart.id + '-legend html-legend">');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[i].backgroundColor + '"></span>');
                        if (chart.data.datasets[i].label) {
                            text.push(chart.data.datasets[i].label);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul>');
                    return text.join('');
                }
            }
        });

        // Generate HTML legend for Statistics Chart
        var myLegendContainer = document.getElementById("myChartLegend");
        myLegendContainer.innerHTML = statisticsChart.generateLegend();

        // Bind onClick event to all LI-tags of the legend
        var legendItems = myLegendContainer.getElementsByTagName('li');
        for (var i = 0; i < legendItems.length; i += 1) {
            legendItems[i].addEventListener("click", function () {
                // Legend click handler if needed
            }, false);
        }
    });
</script>