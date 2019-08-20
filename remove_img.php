<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php'; 
	if (!isset($_SESSION['id']) || !isset($_SESSION['sa']) || (isset($_SESSION['sa']) && $_SESSION['sa'] != "1")) {
		header('Location: ./'); 
		exit;
	}
	extract($_GET);
	// On récupère les informations de l'utilisateur grâce à son ID
	$afficher_profil = $db->query('SELECT * FROM `Image` WHERE id = "'.$id.'"');
	$afficher_profil = $afficher_profil->fetch();
	if(!isset($afficher_profil['id'])){
		header('Location: ./list_img.php');
		;exit;
	}
	$req = $db->query('DELETE FROM `Image` WHERE `Image`.`id` = "'.$id.'"');
	header("Location: ./list_img.php");
	exit;
?>