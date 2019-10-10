<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
		if (isset($_SESSION['logged_on']) && isset($_SESSION['id']) && isset($_POST) && isset($_POST)) {
			extract($_POST);
			$id = $_SESSION['id'];
			$req = $db->prepare('INSERT INTO `Comment` (`user_id`, `id_image`,`description`) VALUES (?, ?, ?)');
			$req->execute(array($id, $image, $com));
			unset($_POST);
			header('Location: ./galerie.php');
		}
?>