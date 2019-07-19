<?php
	session_start();
	session_unset($_SESSION);
	$_SESSION['loggued_on'] == "";
	$_SESSION['root'] = "0";
	header("Location: index.php");
?>