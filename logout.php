<?php
	session_destroy();
	session_start();
	$_SESSION['loggued_on'] = "0";
	$_SESSION['sa'] = "0";
	header("Location: index.php");
?>