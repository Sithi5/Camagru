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
			height: 35vw;
			width: 35vw;
			max-height: 498px;
			max-width: 498px;
		}
		#mega_box {
			height: 30vw;
			max-height: 430px;
			overflow: auto;
		}
		#box {
			text-align:left;
			border: black solid 1px;
			max-width: 500px;
			margin: auto;
			word-wrap: break-word;
		}
		table {
		border: 0;
		background-color: white;
		}
		td { 
		width:50%;
		}
		tr {
			text-align: center;
		}
		#namespace
		{
			max-height: 10px;
		}
		#comment {
			height: 10vw;
			width: 20vw;
			max-width: 200px;
		}
		#like {
			height: 1vw;
			width: 10%;
		}
		.border_bottom {
			border-bottom:1px solid darkgrey;
		}
		.border_right {
			border-right:1px solid darkgrey;
		}
		#close-img {
			position: absolute;
			color: #000;
			font-size: 20px;
			margin-top: -10px;
			margin-right: -2vw;
			font-weight: bold;
		}
		#close-img:hover,
		#close-img:focus {
			color: red;
			cursor: pointer;
		}

		</style>
	<head>
	<body>
		<?php
			$reponse = $db->query('SELECT `Comment`.`id`, `Comment`.`user_id`, Comment.`id_image`,
			`Comment`.`description`, `Comment`.`creation_date`,
			`Image`.`id` as img_id, `Image`.`like`, 
			`Image`.`user_id` as `id_user_img` FROM `Comment`
			INNER JOIN `Image` ON Comment.id_image = `Image`.`id`
			WHERE `Image`.`id`= "'.$profil_image['id_image'].'"');
			$reponse = $reponse->fetchAll();
			$like = $db->query('SELECT img_id, liker_id FROM `like` WHERE img_id = "'.$profil_image['id_image'].'"
								AND liker_id = "'.$_SESSION['id'].'"');
		?>
		<div width="50%" height="100%" style="position:relative; float:left">
			<img class="imgs" src="<?= $profil_image['image_path']?>"></td>
		</div>
		<div width="50%" height="100%" style="position:relative; float:left">
			<table class="table">
				<tbody>
					<tr>
						<td class="border_bottom" id="namespace">Nom du mec
						<?php echo '<a class="close" id="close-img" onclick="hide_modal('.$count.')">&#10006</a>'?>
						</td>
					</tr>
					<tr>
						<td id="comment" class="border_bottom">
							<div id="mega_box">
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
							</div>
						</td>
					</tr>
					<tr>
						<td class="border_right" id="like"><img style="width:2vw; height:2vw; max-width:30px; max-height:30px" src="./ressources/img/jaime.png"><?=$donnees['like']?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>