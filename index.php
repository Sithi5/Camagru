<?php session_start();
require 'config/database.php';
require 'config/connexiondb.php';
require './hashing/hash.php';
$magic = "c00f0c4675b91fb8b918e4079a0b1bac";
print_r($_SESSION);
?>
<html>

<head>
	<meta http-equiv="refresh" content="60" />

	<meta charset="UTF-16">
	<title>Mes projets Web</title>
	<link rel="stylesheet" type="text/css" href="./css/index.css">
	<link rel="stylesheet" type="text/css" href="./css/modal.css">

</head>

<body>
	<?php include 'menu.php' ?>
	<div class="slide-container">
		<img id="images-slideshow" src="ressources\img\menu-des-roulants-preview.jpg" alt="slideshow">
		<p id="current-slide-number"></p>
		<a class="prev" onclick="slideShow(-1, 1, 0, 0)">&#10094;</a>
		<a class="next" onclick="slideShow(1, 1, 0, 0)">&#10095;</a>
		<div style="text-align:center">
			<a class="dot" onclick="slideShow(0, 1, 1, 0)"></a>
			<a class="dot" onclick="slideShow(0, 1, 2, 0)"></a>
			<a class="dot" onclick="slideShow(0, 1, 3, 0)"></a>
		</div>
	</div>
	<!-- The Modal connection -->
	<div id="modal01" class="connect-modal">
		<div class="connect-modal-content">
			<div class="connect-container">
				<?php
				include './login/connexion.php' ?>
			</div>
		</div>
	</div>
	<!-- End of Modal -->
	<!-- The Modal inscription -->
	<div id="modal02" class="inscri-modal">
		<div class="inscri-modal-content">
			<div class="inscri-container">
				<?php
				include './login/inscription.php' ?>
			</div>
		</div>
	</div>
	<!-- End of Modal -->
</body>

</html>
<script src="./script/index.js"></script>
<script src="./script/modal.js"></script>