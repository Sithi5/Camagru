<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<title> Liste des Users </title>
		<style>
		#remove {
			width: 10px;
			height: 10px;
			margin-left: 4vw;
		}
		</style>
	</head>
	<body>
		<?php
			session_start();
			if (!isset($_SESSION['id']) || !isset($_SESSION['sa']) || (isset($_SESSION['sa']) && $_SESSION['sa'] != "1")) {
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
				<th>Modification</th>
				<th>Suppression</th>
			</tr>
			<?php
				require 'config/database.php';
				require 'config/connexiondb.php';
				$reponse = $db->query("SELECT * FROM `User`");
				$reponse = $reponse->fetchAll();
				
				
				//$reponse = $db->query('SELECT * FROM User');
				// Foreach agit comme une boucle mais celle-ci s'arrête de façon intelligente. 
				// Elle s'arrête avec le nombre de lignes qu'il y a dans la variable $afficher_profil
				// La variable $afficher_profil est comme un tableau contenant plusieurs valeurs
				// pour lire chacune des valeurs distinctement on va mettre un pointeur que l'on appellera ici $ap
				foreach($reponse as $donnees){
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
						 <td><a href="voir_profil.php?id=<?= $donnees['id'] ?>">Modifier le profil</a></td>
						<td><a href="remove.php?id=<?= $donnees['id']?>"><img id="remove" src="./ressources/img/remove.png" alt="Supprimer"></a></td>
					</tr>
				<?php } ?>
		</table>
	</body>
</html>