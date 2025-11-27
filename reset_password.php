<?php
include('includes/config.php'); 
$page_title = "Đặt lại Mật khẩu";
$meta_description = "Trang đặt lại mật khẩu";
include('includes/header.php'); 

// Logic kiểm tra Token và Email
if(isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    // Chuẩn bị câu truy vấn
    $query = $con->prepare("SELECT * FROM users WHERE email=? AND reset_token=? AND reset_token_expires > NOW()");
    $query->bind_param("ss", $email, $token);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows === 0) {
        die("<div style='text-align:center; padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;'>Token không hợp lệ hoặc đã hết hạn.</div>");
    }
} else {
    die("<div style='text-align:center; padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;'>Yêu cầu không hợp lệ.</div>");
}
?>

<?php 
?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        
        <div class="card shadow-sm">
          <div class="card-header bg-success text-white text-center">
            <h4>Đặt lại Mật khẩu Mới</h4>
          </div>
          <div class="card-body">
            
            <form method="POST" action="update_password.php">
                
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <div class="form-group">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                </div>
                
                <div class="form-group mt-3">
                    <label for="cpassword">Xác nhận Mật khẩu mới</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Xác nhận mật khẩu mới" required>
                </div>
                
                <button type="submit" class="btn btn-success btn-block mt-4">Xác nhận Đặt lại Mật khẩu</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>