<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./css/menu.css">
	</head>
	<body>
		<div class="topnav" id="myTopnav">
			<a href="./"
				<?php if ($_SERVER['PHP_SELF'] === "/index.php")
				echo 'class="active"'?>
			>Accueil</a>
			<a href="./galerie.php"
			<?php if ($_SERVER['PHP_SELF'] === "/galerie.php")
				echo 'class="active"'?>
			>Galerie</a>
			<?php
				if (!isset($_SESSION['logged_on'])) {
					echo '<a href="#" onclick="connexion_onclick()" >Connexion</a>';
					echo '<a href="#" onclick="inscri_onclick()" >Inscription</a>';
					echo '<a href="./config/tmp.php">Co root tmp</a>';
				}
				else {
					echo '<div class="dropdown">
								<button class="dropbtn">Mon Compte
									<i class="fa fa-caret-down"></i>
								</button>
								<div class="dropdown-content">
									<a href="./profil.php">Afficher mon profil</a>
									<a href="./modif_profil.php">Modifier mon profil</a>
									<a href="./modifier_mdp.php">Modifier mon mot de passe</a>
								</div>
							</div> ';
					if (isset($_SESSION['sa'], $_SESSION['logged_on'])) {
						echo '<div class="dropdown">
								<button class="dropbtn">Administration 
									<i class="fa fa-caret-down"></i>
								</button>
								<div class="dropdown-content">
									<a href="./list_users.php">Liste des users</a>
									<a href="list_img.php">Liste des Images</a>
								</div>
							</div> ';
					}
					echo '<a href="logout.php">Logout</a>';
				}
			?>
			<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
		</div>
		<div style="padding-left:16px"></div>
		<script>
			function myFunction() {
				var x = document.getElementById("myTopnav");
				if (x.className === "topnav") {
					x.className += " responsive";
				} else {
					x.className = "topnav";
				}
			}
		</script>
	<script src="./script/modal.js"></script>
	</body>
</html>
