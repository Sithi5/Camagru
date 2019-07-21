<?php
	session_start();
	require 'config/database.php';
	require 'config/connexiondb.php';
	// Si session dans ce cas go index
	if ($_SESSION['loggued_on'] == '0' || $_SESSION['id'] == "0") {
		header('Location: ./'); 
		exit;
	}
	if (!empty($_POST)) {
		extract($_POST);
		$valid = true;
		$modif = 0;
		if (isset($_POST['modification_profile'])){
			$mdp = trim($mdp);
			$confmdp = trim($confmdp);
			if ($mdp != $confmdp){
				$valid = false;
				$er_mdp = "La confirmation du mot de passe ne correspond pas";
			}
			if ($valid) {
				$mdph = hash("sha512", $mdp);
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
		<title>Modification du profile</title>
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
		<h1 style="center">Modification du profile</h1>
		<form method="post" >
			<?php
				session_start();
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
			<button type="submit" name="modification_profile">Envoyer</button>
		</form>
		</center>
	</body>
</html>