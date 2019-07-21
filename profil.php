<?php
	session_start();
	require 'config/database.php';
	require 'config/connexiondb.php'; 
	// S'il n'y a pas de session alors on ne va pas sur cette page
	if (!isset($_SESSION['loggued_on']) || $_SESSION['loggued_on'] == '0'
		|| !isset($_SESSION['id']) || $_SESSION['id'] == "0") {
		header('Location: ./'); 
		exit; 
	}
	$res = $_SESSION['id'];
	// On récupère les informations de l'utilisateur connecté
	$req = $db->query("SELECT * FROM User WHERE id = $res");
	$afficher_profil = $req->fetch();
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Mon profil</title>
	<head>
	<body>
		<?php include("menu.php") ?>
		<h2>Votre profil</h2>
		<div>Quelques informations sur vous : </div>
		<ul>
			<li>Votre Login est : <?= $afficher_profil['login'] ?></li>
			<li>Votre Prenom est : <?= ucfirst($afficher_profil['prenom']) ?></li>
			<li>Votre Nom est : <?= ucfirst($afficher_profil['nom']) ?></li>
			<li>Votre Mail est : <?= $afficher_profil['mail'] ?></li>
			<li>Votre compte a été crée le : <?= $afficher_profil['creation_date'] ?></li>
		</ul>
	</body>
</html>