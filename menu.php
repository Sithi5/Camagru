<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Menu</title>
		<style>
		body {
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.navbar {
			margin-bottom: 20px;
		}
		</style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/menu.css">
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="./">Camagru</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li <?php if ($_SERVER['PHP_SELF'] === "./") {
								echo 'class="active"';
							}?>>
							<a href="./">Accueil</a></li>
				<li><a href="./galerie.php">Galerie</a></li>
	
				<?php
	//if is not logged, display connection or inscription
	if (!isset($_SESSION['logged_on'])) {
		echo '<li ';
		if ($_SERVER['PHP_SELF'] === "/connexion") {
			echo 'class="active"';
		}
		echo '><a onclick="connexion_onclick()" href="#">Connexion</a></li>';
		echo '<li ';
		if ($_SERVER['PHP_SELF'] === "/inscription") {
			echo 'class="active"';
		}
		echo '><a onclick="inscri_onclick()" href="#">Inscription</a></li>';
	}

//if is logged, display the dropdown
if (isset($_SESSION['logged_on'])) echo '
				<li class="dropdown">
				<div href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mon Compte<span class="caret"></span></div>
				<ul class="dropdown-menu" role="menu">
				<li><a href="./profil.php">Afficher mon profil</a></li>
				<li><a href="./modif_profil.php">Modifier mon profil</a></li>
				<li><a href="./modifier_mdp.php">Modifier mon mot de passe</a></li>
				</ul>
				</li>';

				//if is logged as admin?
				if (isset($_SESSION['sa'], $_SESSION['logged_on'])) echo '
				<li class="dropdown">
				<div href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration<span class="caret"></span></div>
				<ul class="dropdown-menu" role="menu">
				<li class="dropdown-header">Utilisateurs</li>
				<li><a href="./list_users.php">Liste des utilisateurs</a></li>
				<li class="divider"></li>
				<li class="dropdown-header">Galerie</li>
				<li><a href="list_img.php">Liste des Images</a></li>
				</ul>
				</li>';
				//if is logged, button to unlog
				if (isset($_SESSION['logged_on'])) echo '<li><a href="logout.php">Logout</a></li>';
				 ?>
				<li><a href="./config/tmp.php">Co root tmp</a></li>
			</ul>
			</div>
			</nav>
		</div>
		<script src="./script/navbar.js"></script>
		<script src="./script/modal.js"></script>
	</body>
</html>
