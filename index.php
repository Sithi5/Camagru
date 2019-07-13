<html>
	<head>
		<meta charset="UTF-8">
		<title>Mes projets Web</title>
	</head>
	<body>
		<p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p>
	<button onclick="window.location.href = 'menu.html';">menu des roulants</button>
	<button onclick="window.location.href = 'inscription.html';">inscription</button>
	<button onclick="window.location.href = 'Camagru.php';">Camagru</button>
	<?php
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=Camagru;charset=utf8', 'julien', 'root');
		}
		// Si on y arrive pas
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
		// REquete SQL, on selectionne tout
		$reponse = $db->query('SELECT * FROM User');
		// On affiche  le tout avec le while et du html
		while ($donnees = $reponse->fetch()) // recup sous formne de tab les donnes de la table
		{
	?>
		<p>
			<strong>ID</strong> : <?php echo $donnees['id']; ?><br />
			user : <?php echo $donnees['login']; ?> <br />
			email :  <?php echo $donnees['mail']; ?> <br />
			passwd <?php echo $donnees['passwd']; ?> <br />
			<?php if ($donnees['root'] === "1") echo "Utilisateur Root" ?> <br />
		</p>
	<?php
		}
	?>

	</body>
</html>
