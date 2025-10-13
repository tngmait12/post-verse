<?php 

if($_SESSION['auth_role'] != "2")
    {
        $_SESSION['message'] = "You are not authorized as Super Admin to access this page.";
        header("Location: index.php");
        exit(0);
    }

?>