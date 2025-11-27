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
    $_SESSION['message'] = "Something went wrong!";
    header("Location: index.php");
    exit(0);
  }
}
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">My Profile</h3>
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
          <a href="#">Profile</a>
        </li>
      </ul>
    </div>
    <?php include('../message.php') ?>

    <div class="row">
      <!-- Left Column: Profile Summary -->
      <div class="col-md-4">
        <div class="card card-profile">
          <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
            <div class="profile-picture">
              <div class="avatar avatar-xl">
                <?php if (!empty($user_data['image'])): ?>
                  <img src="../uploads/users/<?= $user_data['image']; ?>" alt="Profile Image"
                    class="avatar-img rounded-circle">
                <?php else: ?>
                  <img src="../images/user.png" alt="Profile Image" class="avatar-img rounded-circle">
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="user-profile text-center">
              <div class="name"><?= $user_data['fname'] . ' ' . $user_data['lname']; ?></div>
              <div class="job"><?= $user_data['role_as'] == '1' ? 'Administrator' : 'User'; ?></div>

              <div class="social-media mt-3">
                <?php if (!empty($user_data['facebook'])): ?>
                  <a href="<?= htmlspecialchars($user_data['facebook']); ?>" target="_blank"
                    class="btn btn-info btn-twitter btn-sm btn-link" data-toggle="tooltip" data-placement="top"
                    title="Facebook">
                    <span class="btn-label just-icon"><i class="fab fa-facebook"></i></span>
                  </a>
                <?php endif; ?>
                <?php if (!empty($user_data['github'])): ?>
                  <a href="<?= htmlspecialchars($user_data['github']); ?>" target="_blank"
                    class="btn btn-primary btn-twitter btn-sm btn-link" data-toggle="tooltip" data-placement="top"
                    title="GitHub">
                    <span class="btn-label just-icon"><i class="fab fa-github"></i></span>
                  </a>
                <?php endif; ?>
                <?php if (!empty($user_data['linkedin'])): ?>
                  <a href="<?= htmlspecialchars($user_data['linkedin']); ?>" target="_blank"
                    class="btn btn-primary btn-twitter btn-sm btn-link" data-toggle="tooltip" data-placement="top"
                    title="LinkedIn">
                    <span class="btn-label just-icon"><i class="fab fa-linkedin-in"></i></span>
                  </a>
                <?php endif; ?>
              </div>

              <div class="view-profile mt-4">
                <a href="profile-edit.php" class="btn btn-secondary w-100">Edit Profile</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Profile Details -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Profile Details</h4>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-4 fw-bold text-muted">Full Name</div>
              <div class="col-md-8"><?= $user_data['fname'] . ' ' . $user_data['lname']; ?></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 fw-bold text-muted">Email Address</div>
              <div class="col-md-8"><?= htmlspecialchars($user_data['email']); ?></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 fw-bold text-muted">Phone Number</div>
              <div class="col-md-8"><?= htmlspecialchars($user_data['phone']); ?></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 fw-bold text-muted">Gender</div>
              <div class="col-md-8 text-capitalize"><?= htmlspecialchars($user_data['gender']); ?></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 fw-bold text-muted">Account Role</div>
              <div class="col-md-8">
                <span class="badge badge-<?= $user_data['role_as'] == '1' ? 'success' : 'primary' ?>">
                  <?= $user_data['role_as'] == '1' ? 'Administrator' : 'User' ?>
                </span>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 fw-bold text-muted">Joined Date</div>
              <div class="col-md-8">
                <?= isset($user_data['created_at']) ? date('d F, Y', strtotime($user_data['created_at'])) : 'N/A' ?>
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