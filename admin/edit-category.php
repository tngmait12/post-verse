<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Forms</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="index.php">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="view-categories.php">Categories</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Category</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include('../message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Category</div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $cat_id = $_GET['id'];
                            $category = "SELECT * FROM categories WHERE id='$cat_id' ";
                            $category_run = mysqli_query($con, $category);
                            if (mysqli_num_rows($category_run) > 0) {
                                foreach ($category_run as $cat_data) {
                                    ?>
                                    <div class="row ">
                                        <div class="col-md-12 col-lg-12">
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="cat_id" value="<?= $cat_data['id']; ?>">
                                                <div class="form-group">
                                                    <label for="name" class="fw-bold">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="<?= $cat_data['name']; ?>" required placeholder="Enter Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="slug" class="fw-bold">Slug (URL)</label>
                                                    <input type="text" class="form-control" id="slug" name="slug"
                                                        value="<?= $cat_data['slug']; ?>" required placeholder="Enter Slug">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="fw-bold">Description</label>
                                                    <textarea name="description"><?= $cat_data['description']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_title" class="fw-bold">Meta title</label>
                                                    <input type="text" class="form-control" id="meta_title"
                                                        value="<?= $cat_data['meta_title']; ?>" name="meta_title"
                                                        placeholder="Enter Meta Title">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Navbar Status</label>
                                                        <input class="form-check-input" name="navbar_status"
                                                            <?= $cat_data['navbar_status'] == '1' ? 'checked' : '' ?> type="checkbox">
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Status</label>
                                                        <input class="form-check-input" name="status" <?= $cat_data['status'] == '1' ? 'checked' : '' ?> type="checkbox">
                                                    </div>
                                                </div>
                                                <div class="card-action">
                                                    <button type="submit" name="update_category"
                                                        class="btn btn-success">Submit</button>
                                                    <a href="view-categories.php" class="btn btn-danger">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <h4>No Record Found</h4>
                                <?php
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
include('includes/script.php');
?>