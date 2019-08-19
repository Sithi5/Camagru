<?php
session_start();
$_SESSION['sa'] = "1";
$_SESSION['logged_on'] = "1";
$_SESSION['id'] = "1";
header('Location: ../.');
exit();
?>