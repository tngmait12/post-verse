<?php 

$host = "localhost";
$username = "root";
$password = "";
$database = "post_verse";

try{
    $con = mysqli_connect($host, $username, $password, $database);
}catch(Exception $e){
    header("Location: ../errors/dberror.php");
    die();
}
?>