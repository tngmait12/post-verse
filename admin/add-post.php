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
                    <a href="view-posts.php">Posts</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Add Post</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include('../message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add Post</div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12 col-lg-12">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
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
                                        <label for="slimageug" class="fw-bold">Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="fw-bold">Description</label>
                                        <textarea id="editor" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title" class="fw-bold">Meta title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            placeholder="Enter Meta Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description" class="fw-bold">Meta Description</label>
                                        <textarea name="meta_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_as" class="fw-bold">Category List</label>
                                        <?php
                                        $category = "SELECT id, name FROM categories WHERE status='0' ";
                                        $category_run = mysqli_query($con, $category);
                                        if (mysqli_num_rows($category_run) > 0) {
                                            ?>
                                            <select name="category_id" required class="form-control">
                                                <option value="">--Select Category--</option>
                                                <?php
                                                foreach ($category_run as $cat_item) {
                                                    ?>
                                                    <option value="<?= $cat_item['id']; ?>"><?= $cat_item['name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                        } else {
                                            ?>
                                            <h5>No Category Available</h5>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" name="add_post" class="btn btn-success">Submit</button>
                                        <a href="view-posts.php" class="btn btn-danger">Cancel</a>
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