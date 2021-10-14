<?php

$server_username = "root";
$server_password = "";
$server_host = "localhost";
$database = 'democode';

$conn = mysqli_connect($server_host, $server_username, $server_password, $database) or die("データベースを連携できません！");
mysqli_query($conn, "SET NAMES 'UTF8'");

?>
