<?php
	// On se connecte
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=Camagru;charset=utf8', 'julien', 'root');
	}
	// Si on y arrive pas
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	// Insertion des trucs en post
	$req = $db->prepare('INSERT INTO `User` (`login`, `mail`, `passwd`, `root`) VALUES (?, ?, ?, "0")');
	$req->execute(array($_POST['pseudo'], $_POST['email'], $_POST['passwd']));
	// On redirige
	header('Location: index.php');
?>