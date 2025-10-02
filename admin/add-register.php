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
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Forms</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Basic Form</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include('../message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add User</div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6 col-lg-4">
                                <form action="code.php" method="POST">
                                    <div class="form-group">
                                        <label for="first_name" class="fw-bold">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="fname" required  placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="fw-bold">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="lname" required  placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="fw-bold">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" required  placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="fw-bold">Password</label>
                                        <input type="password" class="form-control" id="password" required name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="role_as" class="fw-bold">Role</label>
                                        <select name="role_as" id="role_as" class="form-control">
                                            <option value="">--Select Role--</option>
                                            <option value="1" >Admin</option>
                                            <option value="0" >User</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="form-check">
                                            <label class="form-check-label">Status</label>
                                            <input class="form-check-input" name="status" type="checkbox">
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" name="add_user" class="btn btn-success">Submit</button>
                                        <a href="view-register.php" class="btn btn-danger">Cancel</a>
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