<?php session_start();
require './config/database.php';
require './config/connexiondb.php';
require './hashing/hash.php';
$magic = "c00f0c4675b91fb8b918e4079a0b1bac";
?>
<html>

<head>
	<meta charset="UTF-16">
	<title>Mes projets Web</title>
	<link rel="stylesheet" type="text/css" href="./css/slideshow.css">
	<link rel="stylesheet" type="text/css" href="./css/camera.css">
	<link rel="stylesheet" type="text/css" href="./css/modal.css">

</head>

<body>
	<?php
	include 'menu.php';
	if (isset($_SESSION['logged_on'])) {
		echo "<br><br>";
	}
	?>
	<!--slideshow-->
	<div class="slide-container">
		<img id="images-slideshow" src="./ressources\img\menu-des-roulants-preview.jpg" alt="slideshow">
		<p id="current-slide-number"></p>
		<a class="prev" onclick="slideShow(-1, 1, 0, 0)">&#10094;</a>
		<a class="next" onclick="slideShow(1, 1, 0, 0)">&#10095;</a>
		<div style="text-align:center">
			<a class="dot" onclick="slideShow(0, 1, 1, 0)"></a>
			<a class="dot" onclick="slideShow(0, 1, 2, 0)"></a>
			<a class="dot" onclick="slideShow(0, 1, 3, 0)"></a>
		</div>
	</div>
	<!---end of slideshow-->
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
		<div class="modal-image">
			<?php
			include './camera.php' ?>
		</div>
	</div>
	<!-- End of Modal -->
</body>

</html>
<script src="./script/index.js"></script>
<script src="./script/modal.js"></script>