<?php
	session_start();
	require 'config/database.php';
	require 'config/connexiondb.php'; 
	if (!isset($_SESSION['id']) || !isset($_SESSION['sa']) || (isset($_SESSION['sa']) && $_SESSION['sa'] != "1")) {
		header('Location: index.php'); 
		exit;
	}
	extract($_GET);
	echo $id;
	// On récupère les informations de l'utilisateur grâce à son ID
	$afficher_profil = $db->query('SELECT * FROM `Comment` WHERE id = "'.$id.'"');
	$res = $afficher_profil->fetch();
	if(!isset($res['id'])){
		header('Location: modif_com'.$_GET['id_image']);
		exit;
	}
	$req = $db->query('DELETE FROM `Comment` WHERE `Comment`.`id` = "'.$id.'"');
	header('Location: modif_com'.$_GET['id_image']);
	exit;
?>