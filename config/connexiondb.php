<?php
function connexion()
{
	require 'database.php';
	$dns = $dsn = "mysql:host=".$DB_HOST;
	try {
		$connexion = new PDO($dns, $DB_USER, $DB_PASSWORD);
	}
	catch (Exception $e) {
		print "Error message :\t" . $e->getMessage() . "\n";
		exit();
	}
	echo("connexion to db ok!\n");
?>