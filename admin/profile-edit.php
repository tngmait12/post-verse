<?php
include('authentication.php');
include('includes/header.php');

// Lấy ID của user đang đăng nhập từ session
if (isset($_SESSION['auth_user']['user_id'])) {
  $user_id = $_SESSION['auth_user']['user_id'];

  // Câu lệnh SQL để lấy thông tin user và social links
  $query = "SELECT u.*, s.facebook, s.github, s.linkedin 
            FROM users u 
            LEFT JOIN socials s ON u.id = s.user_id 
            WHERE u.id='$user_id' LIMIT 1";
  $query_run = mysqli_query($con, $query);

  if (mysqli_num_rows($query_run) > 0) {
    $user_data = mysqli_fetch_array($query_run);
  } else {
    // Xử lý nếu không tìm thấy user
    echo "<h4>Something went wrong!</h4>";
    return false;
  }
} else {
  echo "<h4>Please login to continue.</h4>";
  return false;
}
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
          <a href="profile.php">Profile</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Edit Profile</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php include('../message.php') ?>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit Profile</div>
          </div>
          <div class="card-body">
            <div class="row ">
              <div class="col-md-12 col-lg-12">
                <form action="code.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="user_id" value="<?= $user_data['id']; ?>">

                  <div class="form-group">
                    <label for="fname" class="fw-bold">First Name</label>
                    <input type="text" class="form-control" id="fname" value="<?= $user_data['fname']; ?>" name="fname"
                      required placeholder="Enter Fist Name">
                  </div>
                  <div class="form-group">
                    <label for="lname" class="fw-bold">Last Name</label>
                    <input type="text" class="form-control" id="lname" value="<?= $user_data['lname']; ?>" name="lname"
                      required placeholder="Enter Last Name">
                  </div>
                  <div class="form-group">
                    <label for="email" class="fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user_data['email']; ?>"
                      required placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                    <label for="image" class="fw-bold">Image</label>
                    <input type="hidden" name="old_image" value="<?= $user_data['image']; ?>">
                    <input type="file" class="form-control" id="image" name="image">

                    <?php if (!empty($user_data['image'])): ?>
                      <img src="../uploads/users/<?= $user_data['image']; ?>" width="100px" class="mt-2">
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="phone" class="fw-bold">Phone</label>
                    <input type="text" class="form-control" id="phone" value="<?= $user_data['phone']; ?>" name="phone"
                      placeholder="Enter Phone">
                  </div>
                  <div class="form-group">
                    <label class="fw-bold d-block">Gender</label>
                    <div class="form-check form-check-inline">
                      <input type="radio" class="form-check-input" id="male" name="gender" value="male"
                        <?= ($user_data['gender'] == 'male') ? 'checked' : '' ?>>
                      <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" class="form-check-input" id="female" name="gender" value="female"
                        <?= ($user_data['gender'] == 'female') ? 'checked' : '' ?>>
                      <label for="female" class="form-check-label">Female</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="facebook" class="fw-bold">Facebook</label>
                    <input type="text" class="form-control" id="facebook"
                      value="<?= isset($user_data['facebook']) ? $user_data['facebook'] : ''; ?>" name="facebook"
                      placeholder="Enter Facebook URL">
                  </div>
                  <div class="form-group">
                    <label for="github" class="fw-bold">Github</label>
                    <input type="text" class="form-control" id="github"
                      value="<?= isset($user_data['github']) ? $user_data['github'] : ''; ?>" name="github"
                      placeholder="Enter Github URL">
                  </div>
                  <div class="form-group">
                    <label for="linkedin" class="fw-bold">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin"
                      value="<?= isset($user_data['linkedin']) ? $user_data['linkedin'] : ''; ?>" name="linkedin"
                      placeholder="Enter Linkedin URL">
                  </div>


                  <div class="card-action">
                    <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
                    <a href="profile.php" class="btn btn-danger">Cancel</a>
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