<?php
session_start();
require 'config/database.php';
require 'config/connexiondb.php';
if (!isset($_SESSION['id']) || !isset($_SESSION['sa']) || (isset($_SESSION['sa']) && $_SESSION['sa'] != "1")) {
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<title> Liste des Images </title>
	<style>
		#remove {
			width: 10px;
			height: 10px;
			margin-left: 4vw;
		}

		.marge {
			margin-left: 2em;
		}

		.switch {
			position: relative;
			display: inline-block;
			width: 30px;
			height: 17px;
		}

		.switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			-webkit-transition: .4s;
			transition: .4s;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 13px;
			width: 13px;
			left: 2px;
			bottom: 2px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}

		input:checked+.slider {
			background-color: #2196F3;
		}

		input:focus+.slider {
			box-shadow: 0 0 1px #2196F3;
		}

		input:checked+.slider:before {
			-webkit-transform: translateX(13px);
			-ms-transform: translateX(13px);
			transform: translateX(13px);
		}

		.slider.round {
			border-radius: 34px;
		}

		.slider.round:before {
			border-radius: 50%;
		}
	</style>
</head>

<body>
	<?php
	include("menu.php");
	?>
	<h2 style="text-align: center"> Liste des Images </h2>
	<br>
	<form method="GET">
		<center>
			<input style="width:250px;" type="search" name="research" placeholder="Recherche..." value="" />
			<input type="submit" value="Valider" />
			<br>
			<br>
			<p>Id: <input type="radio" name="by" value="id" />
				<span class="marge">Login: <input type="radio" name="by" value="login" /></span>
				<br>
				<p>Afficher les roots seulement :
					<label class="switch">
						<input type="checkbox" name="root">
						<span class="slider round"></span>
					</label></p>
	</form>
	<br>
	<table class="table table-bordered">
		<tr>
			<th>Id</th>
			<th>Id_User</th>
			<th>Login</th>
			<th>Path</th>
			<th>Nom</th>
			<th>Like</th>
			<th>Dislike</th>
			<th>Date de Creation</th>
			<th>Utilisateur root</th>
			<th>Modification</th>
			<th>Suppression</th>
		</tr>
		<?php
		$reponse = $db->query("SELECT User.id, User.login, User.`super-root`,
							Image.id as id_image,
							Image.image_path, Image.image_name, Image.like,
							Image.dislike, Image.creation_date FROM `User`
							INNER JOIN `Image` ON User.id = Image.user_id");
		if (isset($_GET) && !empty($_GET['root'])) {
			$root = 1;
			$reponse = $db->query("SELECT User.id, User.login, User.`super-root`,
							Image.id as id_image,
							Image.image_path, Image.image_name, Image.like,
							Image.dislike, Image.creation_date FROM `User`
							INNER JOIN `Image` ON User.id = Image.user_id
							WHERE `super-root` = 1");
		}
		if (isset($_GET) && !empty($_GET['research'])) {
			extract($_GET);
			$root = 0;
			if (!empty($_GET['root']))
				$root = 1;
			if (isset($research) && !empty($research) && isset($by) && $root == 0) {
				if ($by == "id")
					;//$reponse = $db->query('SELECT * FROM `Image` WHERE `id` LIKE "' . $research . '"');
				if ($by == "login")
					;//$reponse = $db->query('SELECT * FROM `Image` WHERE `login` LIKE "%' . $research . '%"');
			} else if (isset($research) && !empty($research) && isset($by) && $root == 1) {
				if ($by == "id")
					;//$reponse = $db->query('SELECT * FROM `Image` WHERE `id` LIKE "' . $research . '" AND `super-root`= 1');
				if ($by == "login")
					;//$reponse = $db->query('SELECT * FROM `Image` WHERE `login` LIKE "%' . $research . '%" AND `super-root`= 1');
			}
		}
		$reponse = $reponse->fetch();
		foreach ($reponse as $donnees) {
			?>
			<tr scope="row">
				<td><?php echo $donnees['id_image']; ?></td>
				<td><?php echo $donnees['id']; ?></td>
				<td><?php echo $donnees['login']; ?></td>
				<td><?php echo $donnees['image_path']; ?></td>
				<td><?php echo $donnees['image_name']; ?></td>
				<td><?php echo $donnees['like']; ?></td>
				<td><?php echo $donnees['dislike']; ?></td>
				<td><?php echo $donnees['creation_date']; ?></td>
				<td><?php
					if ($donnees['super-root'] == "1")
					echo "Oui";
					else echo "Non"; ?></td>
				<td><a href="voir_image.php?id=<?= $donnees['id_image'] ?>">Modifier le post</a></td>
				<td><a href="remove_img.php?id=<?= $donnees['id_image'] ?>"><img id="remove" src="./ressources/img/remove.png" alt="Supprimer"></a></td>
			</tr>
		<?php } ?>
	</table>
	<center>
		<form action="list_img"><button type="submit">Reactualiser</button>
	</center>
</body>

</html>