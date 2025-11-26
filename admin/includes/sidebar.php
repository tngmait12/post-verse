<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="../index.php" class="logo">
                <h2 style="color: white;">POST VERSE</h2>
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
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?= $page == 'index.php' ? 'active' : ''; ?>">
                    <a href="index.php">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Management</h4>
                </li>
                <li class="nav-item <?= $page == 'view-register.php' ? 'active' : ''; ?>">
                    <a href="view-register.php">
                        <i class="fas fa-layer-group"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item <?= $page == 'view-categories.php' ? 'active' : ''; ?>">
                    <a href="view-categories.php">
                        <i class="fas fa-th-list"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item <?= $page == 'view-posts.php' ? 'active' : ''; ?>">
                    <a href="view-posts.php">
                        <i class="fas fa-pen-square"></i>
                        <p>Posts</p>
                    </a>
                </li>
                <li class="nav-item <?= $page == 'review-posts.php' ? 'active' : ''; ?>">
                    <a href="review-posts.php">
                        <i class="fas fa-eye-slash"></i>
                        <p>Review Posts</p>
                    </a>
                </li>
                <li class="nav-item <?= $page == 'profile.php' ? 'active' : ''; ?>">
                    <a href="profile.php">
                        <i class="fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item" style="margin-top: 15px; padding: 0px 10px;">
                    <a href="../index.php" style="background: rgba(255, 255, 255, 0.1); border-radius: 5px;">
                        <i class="fas fa-arrow-left" style="color: #fff;"></i>
                        <p style="color: #fff;">Back to client</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->