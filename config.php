<?php
$host = $_SERVER['HTTP_HOST'];
$root = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$base_url = "http://$host$root";
?>
