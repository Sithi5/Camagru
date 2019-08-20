<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
	if (!isset($_GET))
	{
		header('Location: ./'); 
		exit; 
	}
	// S'il n'y a pas de session alors on ne va pas sur cette page
	extract($_GET);
	$profil_image = $db->query('SELECT User.id, User.login,
									Image.id as id_image, Image.`user_id`,
									Image.image_path, Image.image_name, Image.like,
									Image.dislike, Image.creation_date FROM `User`
									INNER JOIN `Image` ON User.id = Image.`user_id`
									WHERE Image.id = "'.$img.'"');
	$profil_image = $profil_image->fetch();
	if(!isset($profil_image['id_image'])){
		header('Location: ./');
		exit;
	}
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
			float: left;
			height: 500px;
			width: 500px;
		}
		#mega_box {
			border: black solid 1px;
			border-radius: 10px;
			height : auto;
			padding: 10px 10px 10px 10px;
			width: 820px;
			height: 540px;
			overflow: auto;
			margin-left: 0px;
		}
		#box {
			text-align:left;
			border: black solid 1px;
			max-width: 950px;
			margin: auto;
			padding: 1px;
			margin-left: 10px;
			word-wrap: break-word;
		}
		#info {
			margin-top: -20px;
		}
		</style>
	<head>
	<body>
		<?php include("menu.php") ?>
		<center>
		<?php
			$reponse = $db->query('SELECT Comment.id, Comment.user_id, Comment.id_image,
									Comment.description, Comment.creation_date,
									Image.id as img_id, Image.like, Image.dislike FROM `Comment`
									INNER JOIN `Image` ON Comment.id_image = Image.id
									WHERE Image.id = "'.$profil_image['id_image'].'"');
		$reponse = $reponse->fetchAll();
		echo '<div id="mega_box">';
		?>
		<img src="<?= $profil_image['image_path']?>">
		<br><br>
		<?php print_r($_SESSION) ?>
		<p><img style="margin-left: 35vw;margin-right:5px; height:20px; width:20px" src="./ressources/img/jaime.png"><?=$profil_image['like']?>
		<img style="margin-left: 23vw;;margin-right:5px; height:20px; width:20px" src="./ressources/img/jaime_pas.png"><?=$profil_image['dislike']?><p>
		<center>
		<br>
		<?php
		echo '<h3>Commentaires</h3>';
		if (isset($reponse['0']))
		{
			foreach ($reponse as $donnees) {
			?>
			<div id="box"><p style="margin-left: 5px;"><?php echo $donnees['description']?></p>
			</div>
			<br>
		<?php }
		}
		?>
		</div>
		</div>
		<a href="galerie">Revenir a la galerie</a>
		</center>
	</body>
</html>