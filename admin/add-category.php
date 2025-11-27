<?php
include('code-superadmin.php');
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
                    <a href="#">Add Category</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include('../message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add Category</div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12 col-lg-12">
                                <form action="code.php" method="POST">
                                    <div class="form-group">
                                        <label for="name" class="fw-bold">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug" class="fw-bold">Slug (URL)</label>
                                        <input type="text" class="form-control" id="slug" name="slug" required
                                            placeholder="Enter Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="fw-bold">Description</label>
                                        <textarea name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title" class="fw-bold">Meta title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            placeholder="Enter Meta Title">
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="form-check">
                                            <label class="form-check-label">Navbar Status</label>
                                            <input class="form-check-input" name="navbar_status" type="checkbox">
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="form-check">
                                            <label class="form-check-label">Status</label>
                                            <input class="form-check-input" name="status" type="checkbox">
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" name="add_category"
                                            class="btn btn-success">Submit</button>
                                        <a href="view-categories.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>

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