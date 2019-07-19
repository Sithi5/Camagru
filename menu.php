<!DOCTYPE html>
<?php session_start();
print_r($_SESSION); ?>
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
							<li <?php if ($_SERVER['PHP_SELF'] === "/index.php") {
								echo 'class="active"';
							}?>><a href="index.php">Accueil</a></li>
						<?php if ($_SESSION['loggued_on'] == 1) {
					echo '<li ';
					if ($_SERVER['PHP_SELF'] === "/compte.php") {
						echo 'class="active"';
					}
					echo '><a href="">Mon Compte</a></li>';
				}?>
				<?php if ($_SESSION['loggued_on'] == 0) {
					echo '<li ';
					if ($_SERVER['PHP_SELF'] === "/connexion.php") {
						echo 'class="active"';
					}
					echo '><a href="">Connexion</a></li>';
				}?>
				<?php if ($_SESSION['loggued_on'] == 0) {
					echo '<li ';
					if ($_SERVER['PHP_SELF'] === "/inscription.php") {
						echo 'class="active"';
					}
					echo '><a href="inscription.php">Inscription</a></li>';
				}?>
				<?php if ($_SESSION['sa'] == 1 && $_SESSION['loggued_on']  == 1) echo '
				<li class="dropdown">
				<div href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration <span class="caret"></span></div>
				<ul class="dropdown-menu" role="menu">
				<li class="dropdown-eader">Utilisateurs</li>
				<li><a href="list_users.php">Liste des utilisateurs</a></li>
				<li><a href="#">Ajouter un utilisateur</a></li>
				<li><a href="#">Modifier un utilisateur</a></li>
				<li><a href="#">Supprimer un utilisateur</a></li>
				<li class="divider"></li>
				<li class="dropdown-header">Galerie</li>
				<li><a href="#">Actions sur la galerie</a></li>
				</ul>
				</li>'?>
				<?php if ($_SESSION['loggued_on'] == 1) echo '<li><a href="logout.php">Logout</a></li>' ?>
				<li><a href="config/tmp.php">Co root tmp</a></li>
			</ul>
			</div>
			</nav>
		</div>
		<script src="navbar.js"></script>
	</body>
</html>