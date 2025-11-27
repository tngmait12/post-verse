<?php
include('code-superadmin.php');
// include('middleware/superadminAuth.php');
include('includes/header.php');
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Users</h3>
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
                    <a href="view-register.php">Users</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include('../message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Registered Users</h4>
                            <a class="btn btn-primary btn-round ms-auto" href="add-register.php">
                                <i class="fa fa-plus"></i>
                                Add User
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM users WHERE status != '2' ";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $user) {
                                    ?>
                                            <tr>
                                                <td><?= $user['id'] ?></td>
                                                <td><?= $user['fname'] ?></td>
                                                <td><?= $user['lname'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td>
                                                    <?php 
                                                    if($user['role_as'] == '1')
                                                    {
                                                        echo 'Admin';
                                                    }elseif($user['role_as'] == '0')
                                                    {
                                                        echo 'User';
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <div class="form-button-action">
                                                        <a class="btn btn-link btn-primary btn-lg" href="edit-register.php?id=<?= $user['id']; ?>">
                                                                <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="code.php" method="POST">
                                                            <button type="submit"  class="btn btn-link btn-danger" name="delete_user" value="<?= $user['id']; ?>" onclick="if(confirm('Are you sure want to delete this user?')){ this.form.submit(); }">
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
                                            <td colspan="6">No Record Found</td>
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