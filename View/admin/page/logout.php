<?php
require_once('../../Model/DBconnect.php');


if (!isset($_SESSION)) {
    session_start();
} 
unset($_SESSION['user-admin']);
session_destroy();
header('Location: http://localhost/democode/view/admin/login.php');

?>

