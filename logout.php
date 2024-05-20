<?php
include("database.php");

setcookie("user_id", $user_data['id_user'], -(time() + (86400 * 30)));
setcookie("user_email", $user_data['id_user'], -(time() + (86400 * 30)));
setcookie("user_name", $user_data['id_user'], -(time() + (86400 * 30)));
setcookie('login_error', '', time() - 3600, '/');

$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'default.php';
header('Location: ' . 'main.php');
exit();
?>