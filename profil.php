<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php'; 
	// S'il n'y a pas de session alors on ne va pas sur cette page
	if (!isset($_SESSION['logged_on']) || $_SESSION['logged_on'] == '0'
		|| !isset($_SESSION['id']) || $_SESSION['id'] == "0") {
		header('Location: ./'); 
		exit; 
	}
	$res = $_SESSION['id'];
	// On récupère les informations de l'utilisateur connecté
	$req = $db->query("SELECT * FROM User WHERE id = $res");
	$afficher_profil = $req->fetch();
	$reponse = $db->query('SELECT User.id, User.login, User.`super-root`,
							Image.id as id_image,
							Image.image_path, Image.image_name, Image.like,
							Image.creation_date FROM `User`
							INNER JOIN `Image` ON User.id = Image.user_id
							WHERE User.id= "'.$res.'"');
	$reponse = $reponse->fetchAll();
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
		#profil {
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
		img {
			width : 10vw
		}
		#remove {
			width: 2vw;
			height: 2vw;
			position:relative;
			top: -7.5vw;
			right: 2.5vw;
		}
		</style>
	<head>
	<body>
		<?php include("menu.php") ?>
		<center>
		<h2>Votre profil</h2>
		<br>
		<div id="box">
		<img id=profil src="<?php echo $afficher_profil['pp']; ?>">
		<br>
		<div id="info"><h3>Quelques informations sur vous : </h3></div>
		<br>
		<ul>
			<li>Votre login est : <?= $afficher_profil['login'] ?></li>
			<li>Votre prenom est : <?= ucfirst($afficher_profil['prenom']) ?></li>
			<li>Votre nom est : <?= ucfirst($afficher_profil['nom']) ?></li>
			<li>Votre mail est : <?= $afficher_profil['mail'] ?></li>
			<li>Votre compte a été crée le : <?= $afficher_profil['creation_date'] ?></li>
		</ul>
		</div>
		<h2>Vos photos</h2>
		<?php foreach ($reponse as $donnees) {
		?>
		<img src="<?php echo $donnees['image_path'] ?>">
		<a href="./remove_img.php?path=1&id=<?= $donnees['id_image']?>"><img id="remove" src="./ressources/img/remove.png" alt="Supprimer"></a>
		<?php }
		?>
		</center>
	</body>
</html>