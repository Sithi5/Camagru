<html>
<head>
	<meta charset="UTF-8">
	<title>Mes projets Web</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<div>
		<?php include 'menu_test.php' ?>
	</div>
	<br><br><br><br>
	<div id="button-container">
		<button class="button" id="boutton-menu-des-roulants" type="button" onclick="window.location.href = 'menu.html';">menu des roulants</button>
		<button class="button" id="boutton-inscription" type="button" onclick="window.location.href = 'inscription.php';">inscription</button>
		<button class="button" id="boutton-camagru" type="button" onclick="window.location.href = 'Camagru.php';">Camagru</button>
	</div>
	<button class="button" type="button" onclick="Hide_button()">Show/Hide Buttons</button>

</body>
</html>

<script src="index.js"></script>

<?php
require 'config/database.php';
require 'config/connexiondb.php';
$reponse = $db->query('SELECT * FROM User');
while ($donnees = $reponse->fetch()) // recup sous formne de tab les donnes de la table
{
	?>
	<p>
		<strong>ID</strong> : <?php echo $donnees['id']; ?><br />
		user : <?php echo $donnees['login']; ?> <br />
		email : <?php echo $donnees['mail']; ?> <br />
		passwd <?php echo $donnees['pwd']; ?> <br />
		<?php if ($donnees['super-root'] === "1") echo "Utilisateur Root" ?> <br />
	</p>
<?php
}
?>