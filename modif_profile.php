<?php
	session_start();
	require 'config/database.php';
	require 'config/connexiondb.php'; 
	// S'il n'y a pas de session alors on ne va pas sur cette page
	if ($_SESSION['loggued_on'] == '0' || $_SESSION['id'] == "0") {
		header('Location: index.php'); 
		exit; 
	}
	$res = $_SESSION['id'];
	// On récupère les informations de l'utilisateur connecté
	$req = $db->query("SELECT * FROM User WHERE id = $res");
	$afficher_profil = $req->fetch(); 
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Modifier votre profil</title>
	</head>
	<body>
		<?php include ("menu.php") ?>
		<div>Modification</div>
		<form method="post">
			<?php
				if (isset($er_nom)){
				?>
					<div><?= $er_nom ?></div>
				<?php   
				}
			?>
			<input type="text" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }else{ echo $afficher_profil['nom'];}?>" required>   
			<?php
				if (isset($er_prenom)){
				?>
					<div><?= $er_prenom ?></div>
				<?php   
				}
			?>
			<input type="text" placeholder="Votre prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }else{ echo $afficher_profil['prenom'];}?>" required>   
			<?php
				if (isset($er_mail)){
				?>
					<div><?= $er_mail ?></div>
				<?php   
				}
			?>
			<input type="email" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }else{ echo $afficher_profil['mail'];}?>" required>
			<button type="submit" name="modification">Modifier</button>
		</form>
	</body>
</html>