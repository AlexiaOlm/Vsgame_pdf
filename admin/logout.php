<?php
session_start();
session_destroy();

setcookie('email_c', '', time() - 3600, '/');

header('Location: login.php');
exit();
?>