<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
	// S'il n'y a pas de session alors on ne va pas sur cette page
	$profil_image = $db->query('SELECT User.id, User.login,
									Image.id as id_image, Image.`user_id`,
									Image.image_path, Image.image_name, Image.like,
									Image.creation_date FROM `User`
									INNER JOIN `Image` ON User.id = Image.`user_id`
									WHERE Image.id = "'.$donnees['id_image'].'"');
	$profil_image = $profil_image->fetch();
	if(!isset($profil_image['id_image'])){
		exit;
	}
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Mon profil</title>
		<style>
		.imgs {
			height: 500px;
			width: 500px;
		}
		#mega_box {
			height : auto;
			width: 400px;
			height: 350px;
			overflow: auto;
			margin-left: 0px;
		}
		#box {
			text-align:left;
			border: black solid 1px;
			max-width: 750px;
			margin: auto;
			word-wrap: break-word;
		}
		table {
		width:50%;
		border: 0;
		}
		td { 
		width:50%;
		}
		tr {
			text-align: center;
		}
		.border_bottom {
			border-bottom:1px solid darkgrey;
		}
		.border_right {
			border-right:1px solid darkgrey;
		}
		</style>
	<head>
	<body>
		<?php
			$reponse = $db->query('SELECT Comment.id, Comment.user_id, Comment.id_image,
									Comment.description, Comment.creation_date,
									Image.id as img_id, Image.like FROM `Comment`
									INNER JOIN `Image` ON Comment.id_image = Image.id
									WHERE Image.id = "'.$profil_image['id_image'].'"');
			$reponse = $reponse->fetchAll();
			$like = $db->query('SELECT img_id, liker_id FROM `like` WHERE img_id = "'.$profil_image['id_image'].'"
								AND liker_id = "'.$_SESSION['id'].'"');
		?>
		<div width="50%" height="100%" style="position:relative; float: left">
			<img class="imgs" src="<?= $profil_image['image_path']?>"></td>
	</div>
	<div width="50%" height="100%" style="position:relative; float: left">
			<table class="table">
		<tbody>
			<tr>
			<td colspan=2 class="border_bottom" height=50px>Nom du mec</td>
			</tr>
			<tr>
			<td colspan=2 class="border_bottom"><div id="mega_box">
			<?php
			if (isset($reponse['0']))
			{
				foreach ($reponse as $donnees) {
				?>
				<div id="box"><p style="margin-left: 5px;"><?php echo $donnees['description']?></p>
					<small style="margin-left: 10px;">By: <?=$donnees['user_id']?> at: <?=$donnees['creation_date']?></small>
				</div>
				<br>
			<?php }
			}
			?>
			</div></td>
			</tr>
			<tr>
			<td class="border_right" style="width:10%" height=50px><img style="width:30px; height:30px" src="./ressources/img/jaime.png"><?=$donnees['like']?></td>
			<td height=50px>Commentaire</td>
			</tr>
		</tbody>
		</table>
		</div>
	</body>
</html>