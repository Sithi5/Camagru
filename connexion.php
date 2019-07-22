<!DOCTYPE html>

<?php
	session_start();
	require 'config/database.php';
	// Si session dans ce cas go index
	if (isset($_SESSION['loggued_on'])) {
		header('Location: ./');
		exit();
	}
	$login = htmlentities(trim($login));
	echo $login . "\n";
?>

<form action="" method="post">
<input type="text" name="username" placeholder="Enter your username" required>
<input type="password" name="password" placeholder="Enter your password" required>
<input type="submit">