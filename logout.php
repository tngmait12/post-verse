<?php
session_start();

// Xóa toàn bộ session
unset($_SESSION['auth']);
unset($_SESSION['auth_user']);
unset($_SESSION['auth_role']);
session_destroy();

// Chuyển về trang chủ hoặc login
header("Location: index.php");
exit;
?>