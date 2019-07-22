<!DOCTYPE html>

<?php
	session_start();
	require 'config/database.php';
	require 'hash.php';

	// Si session dans ce cas go index
	if (isset($_SESSION['loggued_on'])) {
		header('Location: ./');
		exit();
	}
	if (!empty($_POST)) {
		extract($_POST);
		$login = htmlentities(trim($login));
		$password = shamalo(htmlentities(trim($password)));
		echo "login = " . $login . "\n";
		echo "password = " . $password . "\n";

	}
?>
<html lang="fr">
	<head>
		<meta charset="utf-16">
		<title>Inscription</title>
		<style>
		input {
			height : 25px;
			text-align : center;
		}
		</style>
	</head>
	<body>
<form action="" method="post">
<input type="text" name="login" placeholder="Enter your username" required>
<input type="password" name="password" placeholder="Enter your password" required>
<input type="submit">
</body>