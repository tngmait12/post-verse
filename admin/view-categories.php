<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Categories</h3>
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
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="view-register.php">Categories</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include('../message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List Categories</h4>
                            <a class="btn btn-primary btn-round ms-auto" href="add-category.php">
                                <i class="fa fa-plus"></i>
                                Add Categories
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="add-row"
                                class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug (URL)</th>
                                        <th>Description</th>
                                        <th>Navbar_status</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM categories wHERE status!='2' ORDER BY id DESC";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $cat) {
                                    ?>
                                            <tr>
                                                <td><?= $cat['id'] ?></td>
                                                <td><?= $cat['name'] ?></td>
                                                <td><?= $cat['slug'] ?></td>
                                                <td><?= $cat['description'] ?></td>
                                                <td>
                                                    <?php 
                                                    if($cat['navbar_status'] == '1')
                                                    {
                                                        echo 'On';
                                                    }elseif($cat['navbar_status'] == '0')
                                                    {
                                                        echo 'Off';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($cat['status'] == '1')
                                                    {
                                                        echo 'On';
                                                    }elseif($cat['status'] == '0')
                                                    {
                                                        echo 'Off';
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <div class="form-button-action">
                                                        <a class="btn btn-link btn-primary btn-lg" href="edit-category.php?id=<?= $cat['id']; ?>">
                                                                <i class="fa fa-edit"></i>
                                                        </a>
                                                        <?php if($_SESSION['auth_role'] == '2') :?>
                                                        <form action="code.php" method="POST">
                                                            <button type="submit"  class="btn btn-link btn-danger" name="delete_category" value="<?= $cat['id']; ?>" onclick="if(confirm('Are you sure want to delete this category?')){ this.form.submit(); }">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                        <?php endif; ?>
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