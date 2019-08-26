<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
?>
<html>
	<head>
		<meta http-equiv="refresh" content="60" />

		<meta charset="UTF-16">
		<title>Mes projets Web</title>
		<link rel="stylesheet" type="text/css" href="./css/galerie.css">
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
	</body>
</html>

