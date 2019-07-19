<?php
//lancer avec php config/setup.sh
require 'database.php';
// On se connecte (user:julien mdp:root)
$dns = $dsn = "mysql:host=".$DB_HOST;
$db = new PDO($dsn, $DB_USER, $DB_PASSWORD);
$sql = "CREATE DATABASE IF NOT EXISTS ".$DB_NAME;
	$db->exec($sql);
	$sql = "USE ".$DB_NAME;
	$db->exec($sql);
	$sql = "CREATE TABLE IF NOT EXISTS `User` (
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`login` VARCHAR(8) NOT NULL,
			`mail` VARCHAR(255) NOT NULL,
			`prenom` VARCHAR(255) NOT NULL,
			`nom` VARCHAR(255) NOT NULL,
			`pp` VARCHAR(255) NOT NULL,
			`pwd` VARCHAR(255) NOT NULL,
			`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`super-root` INT NOT NULL DEFAULT '0',
			UNIQUE KEY mail (mail),
			UNIQUE KEY login (login)
		)";
	$db->exec($sql);
	$sql = "CREATE TABLE IF NOT EXISTS `Image` (
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`user_id` VARCHAR(8) NOT NULL,
			`image_path` VARCHAR(255) NOT NULL,
			`image_name` VARCHAR(255) NOT NULL,
			`like` INT NOT NULL DEFAULT '0',
			`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		)";
	$db->exec($sql);
	$sql = "CREATE TABLE IF NOT EXISTS `Comment` (
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`user_id` VARCHAR(8) NOT NULL,
			`description` VARCHAR(255) NOT NULL,
			`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		)";
	$db->exec($sql);
	// Creation admin root
	$sql = "INSERT INTO User (`login`, `prenom`, `nom`, `mail`, `pp`, `pwd`, `super-root`) VALUES ('judumay', 'julien', 'dumay', 'julien.dumay@hotmail.fr', '../ressources/img/test.png', 'test', '1')";
	$db->exec($sql);
	// creation d'une image
	$sql="INSERT INTO Image (`user_id`, `image_path`, `image_name`) VALUES ('admin', 'test.png', '../ressources/img/test.png');";
	$db->exec($sql);
	// creation d'un commentaire
	$sql = "INSERT INTO Comment (`description`, `liker_id`) VALUES ('Ceci est un test', 'judumay')";
	$db->exec($sql);
	echo "FIN DU SETUP\n";
?>