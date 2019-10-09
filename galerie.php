<?php
session_start();
require './config/database.php';
require './config/connexiondb.php';
require './hashing/hash.php';
$magic = "c00f0c4675b91fb8b918e4079a0b1bac";
?>
<html>

<head>
	<meta charset="UTF-16">
	<title>Mes projets Web</title>
	<link rel="stylesheet" type="text/css" href="./css/galerie.css">
	<link rel="stylesheet" type="text/css" href="./css/modal.css">
	<link rel="stylesheet" type="text/css" href="./css/post.css">
</head>

<body>
	<?php include 'menu.php' ?>
	<center>
	<span style="text-decoration: underline;">
		<h2 id="name-galery-txt">WALL OF FAME</h2>
	</span>
	<center>
	<div class="galery">
		<article class="galery-flex-container" style="margin-bottom: 100px;">
			<?php
			$liste = $db->query('SELECT `Image`.image_path, `Image`.id as id_image, `Image`.`like` FROM `Image`');
			$liste = $liste->fetchALL();
			$count = 10;
			$div = 0;
			foreach ($liste as $donnees) {
				if ($div % 3 == 0)
					echo '<div class="column-galery">';
				?>
				<div class="galery-img-container-margin<?php if ($div % 3 == 2) echo '_last'?>">
					<a onclick="modal_onclick(<?= $count ?>)" href="#">
						<div class="galery-img-container">
							<img class="img-in-galery"  src="<?php echo $donnees['image_path'] ?>">
							<div class="overlay">
								<div class="text"><img id="jaime" src="./ressources/img/jaime.png"><?= $donnees['like'] ?>
								</div>
							</div>
						</div>
					</a>
				</div>
				<!-- The Modal Images -->
				<div id="modal<?= $count ?>" class="modal">
					<div class="modal-image-post">
						<?php include "./post.php" ?>
					</div>
				</div>
			<!-- End of Modal -->
			<?php
				$count++;
				if ($div % 3 == 2)
					echo "</div>";
				$div++;
			}
			while ($div % 3 != 0)
			{
			?>
				<div class="galery-img-container-margin<?php if ($div % 3 == 2) echo '_last'?>">
					<div class="galery-img-container">
					</div>
				</div>
			<?php
				$div++;
			}?>
		</article>
	</div>
	<!-- The Modal connection -->
	<div id="modal01" class="modal">
		<div class="modal-content">
			<?php
			include './login/connexion.php' ?>
		</div>
	</div>
	<!-- End of Modal -->
	<!-- The Modal inscription -->
	<div id="modal02" class="modal">
		<div class="modal-content">
			<?php
			include './login/inscription.php' ?>
		</div>
	</div>
	<!-- End of Modal -->
	<!-- The Modal take a picture -->
	<div id="modal03" class="modal">
		<div class="modal-content">
			<?php
			include './camera.php' ?>
		</div>
	</div>
	<!-- End of Modal -->
</body>
<?php include 'footer.html' ?>

</html>
<script src="./script/modal.js"></script>