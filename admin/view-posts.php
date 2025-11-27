<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Posts</h3>
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
                    <a href="#">Posts</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include('../message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">View Posts</h4>
                            <a class="btn btn-primary btn-round ms-auto" href="add-post.php">
                                <i class="fa fa-plus"></i>
                                Add Post
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "
                                        SELECT 
                                            posts.*, 
                                            categories.name AS category_name
                                        FROM 
                                            posts
                                        JOIN 
                                            categories 
                                        ON 
                                            posts.category_id = categories.id
                                        WHERE 
                                            posts.status != '2'
                                        ORDER BY 
                                            posts.id DESC
                                        ";

                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $post) {
                                            ?>
                                            <tr>
                                                <td><?= $post['id'] ?></td>
                                                <td><?= $post['name'] ?></td>
                                                <td>
                                                    <img src="../uploads/posts/<?= $post['image'] ?>" width="100px"
                                                        height="70px" alt="<?= $post['name'] ?>">
                                                </td>
                                                <td><?= $post['meta_description'] ?></td>
                                                <td><?= $post['category_name'] ?></td>
                                                <td>
                                                    <?= $post['status'] == 1 ? "Visible" : "Hidden" ?>
                                                </td>

                                                <td>
                                                    <div class="form-button-action">
                                                        <a class="btn btn-link btn-primary btn-lg"
                                                            href="edit-post.php?id=<?= $post['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="code.php" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                                            <button type="" class="btn btn-link btn-danger" name="delete_post" value="<?= $post['id']; ?>">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
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
include('includes/script.php');
?>