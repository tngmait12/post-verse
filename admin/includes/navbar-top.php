<?php
$user_data = [];
if (isset($_SESSION['auth_user']['user_id'])) {
    $user_id = $_SESSION['auth_user']['user_id'];

    $query = "SELECT fname, lname, email, image FROM users WHERE id = '$user_id' LIMIT 1";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
    }
}
?>

<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pe-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Search ..." class="form-control" />
                </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </form>
                    </ul>
                </li>
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <?php
                            $image_path = "assets/img/profile.jpg";
                            if (!empty($user_data['image'])) {
                                $image_path = "../uploads/users/" . htmlspecialchars($user_data['image']);
                            } else {
                                $image_path = "../images/user.png";
                            }
                            ?>
                            <img src="<?= $image_path; ?>" alt="Avatar" class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold"><?= htmlspecialchars($user_data['fname'] ?? 'User'); ?></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img style="height: auto !important;" src="<?= $image_path; ?>"
                                            alt="image profile" class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4><?= htmlspecialchars(($user_data['fname'] ?? '') . ' ' . ($user_data['lname'] ?? '')); ?>
                                        </h4>
                                        <p class="text-muted">
                                            <?= htmlspecialchars($user_data['email'] ?? 'email@example.com'); ?>
                                        </p>
                                        <div class="buttons-profile" style="display: flex; gap: 5px;">
                                            <a href="./profile.php" class="btn btn-xs btn-secondary btn-sm">View
                                                Profile</a>
                                            <form action="../logout.php" method="post">
                                                <button class="btn btn-xs btn-danger btn-sm"
                                                    type="submit">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>