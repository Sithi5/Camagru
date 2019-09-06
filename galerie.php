<?php
session_start();
require './config/database.php';
require './config/connexiondb.php';
$magic = "c00f0c4675b91fb8b918e4079a0b1bac";
?>
<html>
	<head>
		<meta charset="UTF-16">
		<title>Mes projets Web</title>
		<link rel="stylesheet" type="text/css" href="./css/galerie.css">
		<link rel="stylesheet" type="text/css" href="./css/modal.css">
		<link rel="stylesheet" type="text/css" href="./css/camera.css">
		<link rel="stylesheet" type="text/css" href="./css/post.css">
	</head>
	<body>
		<?php include 'menu.php' ?>
		<center><span style="text-decoration: underline;">
				<h2>WALL OF FAME</h2>
			</span></center>
		<div class="flex-container">
			<?php
				$liste = $db->query('SELECT `Image`.image_path, `Image`.id as id_image, `Image`.`like` FROM `Image`');
				$liste = $liste->fetchALL();
				$count = 10;
				foreach ($liste as $donnees) {
			?>
			<a onclick="modal_onclick(<?= $count ?>)" href="#">
				<div class="container">
					<img width="50px" src="<?php echo $donnees['image_path'] ?>">
					<div class="overlay">
						<div class="text"><img id="jaime" src="./ressources/img/jaime.png"><?= $donnees['like'] ?> </div>
					</div>
				</div>
			</a>
			<!-- The Modal Images -->
			<div id="modal<?= $count ?>" class="modal">
				<div class="modal-image">
					<?php include "./post.php" ?>
				</div>
			</div>
			<!-- End of Modal -->
			<?php
				$count++;
			}
			?>
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