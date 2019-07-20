<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<title> Liste des Users </title>
	</head>
	<body>
		<?php
			session_start();
			if ($_SESSION['sa'] != 1) {
				header('Location: ./'); 
				exit;
			}
			include("menu.php");
		?>
		<h2 style="text-align: center"> Liste des Users </h2>
		<table class="table table-bordered">
			<tr>
				<th>ID</th>
				<th>Pseudo</th>
				<th>Email</th>
				<th>Prenom</th>
				<th>Nom</th>
				<th>PP</th>
				<th>Date de Creation</th>
				<th>Root</th>
			</tr>
			<?php
				require 'config/database.php';
				require 'config/connexiondb.php';
				$reponse = $db->query('SELECT * FROM User');
				// On affiche  le tout avec le while et du html
				while ($donnees = $reponse->fetch()) // recup sous formne de tab les donnes de la table
				{
				?>
					<tr scope="row">
						<td><?php echo $donnees['id']; ?></td>
						<td><?php echo $donnees['login']; ?></td>
						<td><?php echo $donnees['mail']; ?></td>
						<td><?php echo $donnees['prenom']; ?></td>
						<td><?php echo $donnees['nom']; ?></td>
						<td><?php echo $donnees['pp']; ?></td>
						<td><?php echo $donnees['creation_date']; ?></td>
						<td><?php
							if ($donnees['super-root'] == "1")
								echo "Oui";
							else echo "Non"; ?></td>
					</tr>
				<?php } ?>
		</table>
	</body>
</html>