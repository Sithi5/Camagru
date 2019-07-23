<?php
	session_start();
	require 'config/database.php';
	require 'config/connexiondb.php'; 
	require 'hash.php';
	if (!isset($_SESSION['id']) || !isset($_SESSION['sa']) || (isset($_SESSION['sa']) && $_SESSION['sa'] != "1")) {
		header('Location: index.php'); 
		exit;
	}
	
	// Récupèration de l'id passer en argument dans l'URL
	extract($_GET);
	// On récupère les informations de l'utilisateur grâce à son ID
	$afficher_profil = $db->query('SELECT User.id, User.login,
									Image.id as id_image, Image.`user_id`,
									Image.image_path, Image.image_name, Image.like,
									Image.dislike, Image.creation_date FROM `User`
									INNER JOIN `Image` ON User.id = Image.`user_id`
									WHERE Image.id = "'.$id.'"');
	$afficher_profil = $afficher_profil->fetch();
	if(!isset($afficher_profil['id'])){
		header('Location: list_img.php');
		exit;
	}
	if (!empty($_POST)) {
		extract($_POST);
		$valid = true;
		if (isset($_POST['modification_image'])){
			$login = htmlentities(trim($login));
			$prenom = htmlentities(trim($prenom));
			$nom = htmlentities(trim($nom));
			$mail = htmlentities(strtolower(trim($mail)));
			if ($valid) {
				//On insert de facon securisé les donnees recup
				if ($_POST['login'])
				{
					$req = $db->query('UPDATE `User` SET `login` = "'.$login.'" WHERE `id` = "'.$id.'"');
				}
				header('Location: .'.$_SERVER['REQUEST_URI']);
			}
		}
	}
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Mon profil</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/voir_profil.css">
	<head>
	<body>
		<?php include("menu.php") ?>
		<table class="table table-bordered">
			<tr>
				<th><h2 style="text-align : center">Profil de l'image -> id : <?php echo $id ?></h2></th>
				<th><h2 style="text-align : center">Modification de l'Image</h2></th>
			<tr>
			<tr scope="row">
			</tr>
			<td>
			<br>
			<div>Quelques informations sur L'Image : </div>
			<ul>
			<br>
				<li>Le login de l'auteur est : <?php echo $afficher_profil['login'] . " => id : "  . $afficher_profil['user_id']?></li>
				<li>Le nom est : <?= $afficher_profil['image_name'] ?></li>
				<li>Son path est : <?= $afficher_profil['image_path'] ?></li>
				<li>Elle possede : <?= $afficher_profil['like'] ?> like(s)</li>
				<li>Elle possede : <?= $afficher_profil['dislike'] ?> dislike(s)</li>
				<li>Le compte a été crée le : <?= $afficher_profil['creation_date'] ?></li>
				<br>
			</ul>
			<br>
			<center><form action="list_img"><button type="submit">Retour</button></form></center>
			</td>
			<td>
			<center>
			<form method="post" >
				<?php
					session_start();
					?>
				<input size=50 type="text" placeholder="Nouvel auteur" name="auteur" value="" maxlength="10">
				<br>
				<br>
				<input size=50 type="text" placeholder="Nouveau nom" name="auteur" value="" maxlength="10">
				<br>
				<br>
				<input size=50 type="text" placeholder="Nouveau path" name="auteur" value="" maxlength="10">
				<br>
				<br>
				<input size=50 type="text" placeholder="Nouveau nombre de like" name="like" value="" maxlength="10">
				<br>
				<br>
				<input size=50 type="text" placeholder="Nouveau nombre de dislike" name="like" value="" maxlength="10">
				<br>
				<br>
				<button type="submit" name="modification_image">Envoyer</button>
			</form>
			<a href="#">Modifier ses commentaires</a>
			</td>
		</table>
	<br>
	</body>
	</center>
</html>