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
		<style>
		ul {
			list-style: none;
			text-align: left;
			margin-left: 200px;;
		}
		img {
			margin-left:25px;			
			margin-top:25px;			
			float:left;
			height: 150px;
			width: 150px;
		}
		#box {
			background-color: lightgrey;
			box-shadow:15px 15px 10px black;
			border-radius: 10px;
			height:200px;
			width: 600px;
		}
		#info {
			margin-top: -20px;
		}
		</style>
	<head>
	<body>
		<?php include("menu.php") ?>
		<center>
		<h2>Votre profil</h2>
		<br>
		<div id="box">
		<img src="<?php echo $afficher_profil['pp']; ?>">
		<br>
		<div id="info"><h3>Quelques informations sur vous : </h3></div>
		<br>
		<ul>
			<li>Votre Login est : <?= $afficher_profil['login'] ?></li>
			<li>Votre Prenom est : <?= ucfirst($afficher_profil['prenom']) ?></li>
			<li>Votre Nom est : <?= ucfirst($afficher_profil['nom']) ?></li>
			<li>Votre Mail est : <?= $afficher_profil['mail'] ?></li>
			<li>Votre compte a été crée le : <?= $afficher_profil['creation_date'] ?></li>
		</ul>
		</div>
		</center>
	</body>
</html>