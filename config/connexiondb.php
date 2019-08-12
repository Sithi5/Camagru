<?php
	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	}
	catch (Exception $e) {
		print "Error message :\t" . $e->getMessage() . "\n";
		exit();
	}
	echo("connexion to db ok!\n");
?>