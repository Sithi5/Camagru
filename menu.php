<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Menu</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<style>
		body {
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.navbar {
			margin-bottom: 20px;
		}
		</style>
		<link rel="stylesheet" href="css/menu.css">
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
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
				<?php
	//if is not logged, display connection or inscription
	if (!isset($_SESSION['loggued_on'])) {
		echo '<li ';
		if ($_SERVER['PHP_SELF'] === "/connexion") {
			echo 'class="active"';
		}
		echo '><a href="connexion">Connexion</a></li>';
		echo '<li ';
		if ($_SERVER['PHP_SELF'] === "/inscription") {
			echo 'class="active"';
		}
		echo '><a href="inscription">Inscription</a></li>';
	}

//if is logged, display the dropdown
if (isset($_SESSION['loggued_on'])) echo '
				<li class="dropdown">
				<div href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mon Compte<span class="caret"></span></div>
				<ul class="dropdown-menu" role="menu">
				<li><a href="profil">Afficher mon profil</a></li>
				<li><a href="modif_profil">Modifier mon profil</a></li>
				<li><a href="modifier_mdp.php">Modifier mon mot de passe</a></li>
				</ul>
				</li>';

				//if is logged as admin?
				if (isset($_SESSION['sa'], $_SESSION['loggued_on'])) echo '
				<li class="dropdown">
				<div href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration<span class="caret"></span></div>
				<ul class="dropdown-menu" role="menu">
				<li class="dropdown-header">Utilisateurs</li>
				<li><a href="list_users">Liste des utilisateurs</a></li>
				<li class="divider"></li>
				<li class="dropdown-header">Galerie</li>
				<li><a href="#">Actions sur la galerie</a></li>
				</ul>
				</li>';
				//if is logged, button to unlog
				if (isset($_SESSION['loggued_on'])) echo '<li><a href="logout">Logout</a></li>';
				 ?>
				<li><a href="config/tmp">Co root tmp</a></li>
			</ul>
			</div>
			</nav>
		</div>
		<script src="navbar.js"></script>
	</body>
</html>