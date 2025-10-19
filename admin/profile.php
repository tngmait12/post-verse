<?php
include('authentication.php');
include('includes/header.php');

// Lấy ID của user đang đăng nhập từ session
if(isset($_SESSION['auth_user']['user_id'])){
  $user_id = $_SESSION['auth_user']['user_id'];

  // Câu lệnh SQL để lấy thông tin user
  $query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $user_data = mysqli_fetch_array($query_run);
  }
  else
  {
    // Xử lý nếu không tìm thấy user
    $_SESSION['message'] = "Something went wrong!";
    header("Location: index.php");
    exit(0);
  }
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
          <a href="#">Tables</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Profile</a>
        </li>
      </ul>
    </div>
    <?php include('../message.php') ?>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card card-profile">
          <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
            <div class="profile-picture">
              <div class="avatar avatar-xl">
                <?php if (!empty($user_data['image'])): ?>
                  <img src="../uploads/users/<?= $user_data['image']; ?>" alt="" class="avatar-img rounded-circle">
                <?php else: ?>
                  <img src="assets/img/profile.jpg" alt="" class="avatar-img rounded-circle">
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="user-profile text-center">
              <div class="name"><?= $user_data['fname'] . ' ' . $user_data['lname']; ?></div>
              <div class="job"><?= $user_data['role_as'] == '1' ? 'Admin' : 'User'; ?></div>

              <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">
                  <div class="user-profile-info px-md-4 mt-4 text-start">
                    <div class="row mt-3">
                      <div class="col-md-4 col-5"><strong>Email</strong></div>
                      <div class="col-md-8 col-7">: <?= htmlspecialchars($user_data['email']); ?></div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-4 col-5"><strong>Phone</strong></div>
                      <div class="col-md-8 col-7">: <?= htmlspecialchars($user_data['phone']); ?></div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-4 col-5"><strong>Gender</strong></div>
                      <div class="col-md-8 col-7 text-capitalize">: <?= htmlspecialchars($user_data['gender']); ?></div>
                    </div>
                    <?php if (!empty($user_data['social'])): ?>
                    <div class="row mt-2 align-items-center">
                      <div class="col-md-4 col-5"><strong>Social</strong></div>
                      <div class="col-md-8 col-7">: 
                        <a href="<?= htmlspecialchars($user_data['social']); ?>" target="_blank" class="btn btn-icon btn-round btn-primary btn-sm">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </div>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <div class="view-profile mt-4">
                <a href="profile-edit.php" class="btn btn-primary w-100">Edit Profile</a>
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