<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title> Liste des Users </title>
		<style type="text/css">
			table {
				width: 100%;
				border-collapse: collapse;
			}
			td {
				border: 1px solid black;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<?php
			session_start();
			if ($_SESSION['sa'] != 1) {
				header('Location: index.php'); 
				exit;
			}
			include("menu.php")
		?>
		<table>
			<tr>
				<th>ID</th><th>Pseudo</th><th>Email</th><th>Prenom</th><th>Nom</th><th>PP</th><th>Date de Creation</th><th>Root</th>
			</tr>
			<?php
				session_start();
				require 'config/database.php';
				require 'config/connexiondb.php';
				$reponse = $db->query('SELECT * FROM User');
				// On affiche  le tout avec le while et du html
				while ($donnees = $reponse->fetch()) // recup sous formne de tab les donnes de la table
				{
				?>
					<tr>
						<td><?php echo $donnees['id']; ?></td>
						<td><?php echo $donnees['login']; ?></td>
						<td><?php echo $donnees['mail']; ?></td>
						<td><?php echo $donnees['prenom']; ?></td>
						<td><?php echo $donnees['nom']; ?></td>
						<td><?php echo $donnees['pp']; ?></td>
						<td><?php echo $donnees['creation_date']; ?></td>
						<td><?php echo $donnees['super-root']; ?></td>
					</tr>
				<?php
				}?>
		</table>
	</body>
</html>