<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
	$magic = "c00f0c4675b91fb8b918e4079a0b1bac";
?>
<html>
	<head>
		<meta http-equiv="refresh" content="60" />
		<meta charset="UTF-16">
		<title>Mes projets Web</title>
		<link rel="stylesheet" type="text/css" href="./css/galerie.css">
		<link rel="stylesheet" type="text/css" href="./css/modal.css">
	</head>
	<body>
		<?php include 'menu.php'?>
		<center><span style="text-decoration: underline;"><h2>WALL OF FAME</h2></span></center>
		<div class="flex-container">
			<?php
				$liste = $db->query('SELECT `Image`.image_path, `Image`.id as id_image FROM `Image`');
				$liste = $liste->fetchALL();
				foreach ($liste as $donnees) {
			?>
			<a href="./post.php?img=<?= $donnees['id_image']?>">
			<div class="container">
				<img src= "<?php echo $donnees['image_path']?>">
				<div class="overlay">
					<div class="text">Acceder au post</div>
				</div>
			</div></a>
			<?php
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
	</body>

</html>
<script src="./script/modal.js"></script>


