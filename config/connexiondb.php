<?php
	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	}
	// Si on y arrive pas
	catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
?>