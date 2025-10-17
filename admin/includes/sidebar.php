<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.php" class="logo">
                <img
                    src="assets/img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20" />
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
                <li class="nav-item <?= $page == 'profile.php' ? 'active' : ''; ?>">
                    <a href="profile.php">
                        <i class="fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->