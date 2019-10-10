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
	function number_format_short( $n ) {
		if ($n >= 0 && $n < 1000) {
			// 1 - 999
			$n_format = floor($n);
			$suffix = '';
		} else if ($n >= 1000 && $n < 1000000) {
			// 1k-999k
			$n_format = floor($n / 1000);
			$suffix = 'K+';
		} else if ($n >= 1000000 && $n < 1000000000) {
			// 1m-999m
			$n_format = floor($n / 1000000);
			$suffix = 'M+';
		} else if ($n >= 1000000000 && $n < 1000000000000) {
			// 1b-999b
			$n_format = floor($n / 1000000000);
			$suffix = 'B+';
		} else if ($n >= 1000000000000) {
			// 1t+
			$n_format = floor($n / 1000000000000);
			$suffix = 'T+';
		}
	
		return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
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
		<div class="parent_div_container_2">
			<?php echo '<a id="close-img" onclick="hide_modal('.$count.')">&#10006</a>'?>
			<div class="child-post-1">
				<img id="img-post-1" src="<?=$profil_image['image_path']?>">
			</div>
			<div class="child-post-2">
				<center>
					<p width="100%"><?php echo "Posted By: " . $profil_image['login']?></p>
				</center>
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
				<!---after megabox--->
					<img class="like-post" src="./ressources/img/jaime.png">
					<p class="like-post"><?=number_format_short($donnees['like'])?></p>
					<input style="position: flex;" type="text" class="type text">
			</div>
		</div>
	</body>
</html>