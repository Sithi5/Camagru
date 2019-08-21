<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
	require 'hashing/hash.php';
	// Si session dans ce cas go index
	if (!isset($_SESSION['logged_on']) || !isset($_SESSION['id'])) {
		header('Location: ./');
		exit;
	}
	$modif = 0;
	if (!empty($_POST)) {
		extract($_POST);
		$valid = true;
		if (isset($_POST['modification_profil'])){
			$mdp = trim($mdp);
			$confmdp = trim($confmdp);
			if ($mdp != $confmdp){
				$valid = false;
				$er_mdp = "La confirmation du mot de passe ne correspond pas";
			}
			if ($valid) {
				$mdph = shamalo($mdp);
				//On insert de facon securisé les donnees recup
				if ($_POST['mdp'])
				{
					$modif = 1;
					$req = $db->query('UPDATE `User` SET `pwd` = "'.$mdph.'" WHERE `id` = "'.$_SESSION['id'].'"');
				}
			}
		}
	}
?>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Modification du profil</title>
		<style>
		input {
			height : 25px;
			text-align : center;
		}
		</style>
	</head>
	<body>
		<?php include 'menu.php' ?>
		<center>
		<h1 style="center">Modification du profil</h1>
		<form method="post" >
			<?php
				if (isset($er_mdp)){
				?>
					<div><?= $er_mdp ?></div>
				<?php
				}
				else if ($modif == 1){
					?><div>Le mot de passe a bien ete modifie.</div>
				<?php
					$modif = 0;
				}
			?>
			<input size=50 type="password" placeholder="Mot de passe" name="mdp" value="" maxlength="25" required>
			<br>
			<br>
			<input size=50 type="password" placeholder="Confirmer le mot de passe" name="confmdp" maxlength="25" required>
			<br>
			<br>
			<button type="submit" name="modification_profil">Envoyer</button>
		</form>
		</center>
	</body>
</html>