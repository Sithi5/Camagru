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
		<div width="100%" style="position: relative;">
			<?php echo '<a id="close-img" onclick="hide_modal('.$count.')">&#10006</a>'?>
			<div class="parent_div_container_1">
				<div class="child-1">
					<img src="<?= $profil_image['image_path']?>" width="100%">
				</div>
				<div class="child-2-post">
					<p><?php echo "Posted By: " . $profil_image['login'] . $count?>
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
					<img id="like" style="width:2vw; height:2vw; max-width:30px; max-height:30px" src="./ressources/img/jaime.png"><?=$donnees['like']?>
				</div>
			</div>
		</div>
	</body>
</html>