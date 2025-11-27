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
                    <a href="view-register.php">Users</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit User</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <?php include('../message.php') ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit User</div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $user_id = $_GET['id'];
                            $user = "SELECT * FROM users WHERE id='$user_id' ";
                            $user_run = mysqli_query($con, $user);
                            if (mysqli_num_rows($user_run) > 0) {
                                foreach ($user_run as $user_data) {
                        ?>
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-4">
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="user_id" value="<?= $user_data['id']; ?>">
                                                <div class="form-group">
                                                    <label for="first_name" class="fw-bold">First Name</label>
                                                    <input type="text" class="form-control" id="first_name" name="fname" value="<?= $user_data['fname']; ?>" placeholder="Enter First Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="last_name" class="fw-bold">Last Name</label>
                                                    <input type="text" class="form-control" id="last_name" name="lname" value="<?= $user_data['lname']; ?>" placeholder="Enter Last Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="fw-bold">Email address</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user_data['email']; ?>" placeholder="Enter email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="fw-bold">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="role_as" class="fw-bold">Role</label>
                                                    <select name="role_as" id="role_as" class="form-control">
                                                        <option value="">--Select Role--</option>
                                                        <option value="1" <?= $user_data['role_as'] == '1' ? 'selected' : '' ?>>Admin</option>
                                                        <option value="0" <?= $user_data['role_as'] == '0' ? 'selected' : '' ?>>User</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Status</label>
                                                        <input class="form-check-input" name="status" <?= $user_data['status'] == '1' ? 'checked' : '' ?> type="checkbox">
                                                    </div>
                                                </div>                  
                                                <div class="card-action">
                                                    <button type="submit" name="update_user" class="btn btn-success">Submit</button>
                                                    <a href="view-register.php" class="btn btn-danger">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <h4>No record Found</h4>
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