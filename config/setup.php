<?php
$_SESSION['loggued_on'] = "0";
$_SESSION['sa'] = "0";
$_SESSION['id'] = "0";
//lancer avec php config/setup.sh
require 'database.php';
require 'hash.php';
// On se connecte (user:julien mdp:root)
$dns = $dsn = "mysql:host=".$DB_HOST;
try {
	$db = new PDO($dsn, $DB_USER, $DB_PASSWORD);
}
catch (Exception $e) {
	print "Error message :\t" . $e->getMessage() . "\n";
	exit();
}
echo("connection to db ok!\n");
$sql = "CREATE DATABASE IF NOT EXISTS ".$DB_NAME;

$db->exec($sql);
$sql = "USE ".$DB_NAME;
$db->exec($sql);
$sql = "CREATE TABLE IF NOT EXISTS `User` (
		`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`login` VARCHAR(10) NOT NULL,
		`mail` VARCHAR(255) NOT NULL,
		`prenom` VARCHAR(255) NOT NULL,
		`nom` VARCHAR(255) NOT NULL,
		`pp` VARCHAR(255) NOT NULL,
		`pwd` VARCHAR(255) NOT NULL,
		`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		`super-root` INT NOT NULL DEFAULT '0',
		`theme` INT NOT NULL DEFAULT '0'
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
$mdph = shamalo("root");
$req = $db->prepare('INSERT INTO User (`login`, `prenom`, `nom`, `mail`, `pp`, `pwd`, `super-root`) VALUES (?, ?, ?, ?, ?, ?, ?)');
$req->execute(array('judumay', 'julien', 'dumay', 'julien.dumay@hotmail.fr', './ressources/img/default.png', $mdph, '1'));
$req = $db->prepare('INSERT INTO User (`login`, `prenom`, `nom`, `mail`, `pp`, `pwd`, `super-root`) VALUES (?, ?, ?, ?, ?, ?, ?)');
$req->execute(array('mabouce', 'malo', 'bouce', 'ma.sithis@gmail.com', './ressources/img/default.png', $mdph, '1'));
// creation d'une image
$sql="INSERT INTO Image (`user_id`, `image_path`, `image_name`) VALUES ('admin', 'test.png', './ressources/img/test.png');";
$db->exec($sql);
// creation d'un commentaire
$sql = "INSERT INTO Comment (`description`, `liker_id`) VALUES ('Ceci est un test', 'judumay')";
$db->exec($sql);
echo "FIN DU SETUP\n";
?>