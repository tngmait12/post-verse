<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php
    $page = basename($_SERVER['SCRIPT_NAME']);
    switch ($page) {
        case 'index.php':
            $title = "Dashboard";
            break;
        case 'view-register.php':
            $title = "Users";
            break;
        case 'add-register.php':
            $title = "Add User";
            break;
        case 'edit-register.php':
            $title = "Edit User";
            break;
        case 'view-categories.php':
            $title = "Categories";
            break;
        case 'add-category.php':
            $title = "Add Category";
            break;
        case 'edit-category.php':
            $title = "Edit Category";
            break;
        case 'view-posts.php':
            $title = "Posts";
            break;
        case 'add-post.php':
            $title = "Add Post";
            break;
        case 'edit-post.php':
            $title = "Edit Post";
            break;
        case 'detail-post.php':
            $title = "Post Details";
            break;
        case 'review-posts.php':
            $title = "Review Posts";
            break;
        case 'profile.php':
            $title = "Profile";
            break;
        case 'profile-edit.php':
            $title = "Edit Profile";
            break;
        default:
            $title = "Admin Panel";
            break;
    }
    ?>
    <title><?php echo $title ?> - Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/favicon.svg" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"> -->

</head>

<body>
    <div class="wrapper">
        <?php include('includes/sidebar.php'); ?>
        <div class="main-panel">
            <?php include('includes/navbar-top.php'); ?>