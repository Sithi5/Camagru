
<?php
require 'database.php';
//lancer avec php config/setup.sh

// On se connecte (user:julien mdp:root)
$dns = $dsn = "mysql:host=".$DB_HOST;
$db = new PDO($dsn, $DB_USER, $DB_PASSWORD);
$sql = "CREATE DATABASE IF NOT EXISTS ".$DB_NAME;
	$db->exec($sql); 
	$sql = "USE ".$DB_NAME;
	$db->exec($sql); 
	$sql = "CREATE TABLE IF NOT EXISTS `User` (
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`login` varchar(8) NOT NULL,
			`mail` varchar(255) NOT NULL,
			`passwd` varchar(255) NOT NULL,
			`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`root` INT NOT NULL DEFAULT '0')
		";
	$db->exec($sql); 
	$sql = "CREATE TABLE IF NOT EXISTS `Image` ( 
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`user_id` VARCHAR(8) NOT NULL, 
			`image_path` varchar(255) NOT NULL,
			`image_name` varchar(255) NOT NULL,
			`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		)";
	$db->exec($sql); 
	$sql = "CREATE TABLE IF NOT EXISTS `Comment` ( 
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`description` varchar(255) NOT NULL, 
			`image_id` INT NOT NULL,
			`liker_id` VARCHAR(8) NOT NULL, 
			`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		)";
	$db->exec($sql); 
	// Creation admin root
	$sql = "INSERT INTO User (login, mail, passwd, root) VALUES ('judumay', 'julien.dumay@hotmail.fr', 'test', '1')";
	$db->exec($sql);
	// creation d'une image
	$sql="INSERT INTO Image (user_id, image_path, image_name) VALUES ('admin', 'test', '../ressources/img/test');";
	$db->exec($sql);
	// creation d'un commentaire
	$sql = "INSERT INTO Comment (description, image_id, liker_id) VALUES ('Ceci est un test', 1, 'judumay')";
	$db->exec($sql);
	echo "FIN DU SETUP\n";
?>