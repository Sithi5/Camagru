<?php
	session_start();
	require 'config/database.php';
	require 'config/connexiondb.php';
	// Si session dans ce cas go index
	if ($_SESSION['loggued_on'] == 1) {
		header('Location: index.php'); 
		exit;
	}
	if (!empty($_POST)) {
		extract($_POST);
		$valid = true;
		if (isset($_POST['inscription'])){
			$prenom = htmlentities(trim($prenom));
			$nom  = htmlentities(trim($nom));
			$mail = htmlentities(strtolower(trim($mail)));
			$mdp = trim($mdp);
			$confmdp = trim($confmdp);
			if (empty($login)) {
				$valid = false;
				$er_login = ("Le login ne peut pas être vide");
			}
			else if (!empty($login))
			{
				$sql = $db->query('SELECT COUNT(*) AS existe_pseudo FROM User WHERE `login` = "'.$login.'"');
				while ($data = $sql->fetch()) // recup sous formne de tab les donnes de la table
				{
					//Si il n'y a aucune ligne le login est inexistant
					if (($data['existe_pseudo'] != '0')) {
						$valid = false;
						$er_login = ("Le pseudo choisis existe déjà");
					}
				}
			}
			if (empty($prenom)) {
				$valid = false;
				$er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
			}
			if (empty($nom)) {
				$valid = false;
				$er_nom = ("Le nom d' utilisateur ne peut pas être vide");
			}
			if (empty($mail)) {
				$valid = false;
				$er_mail = "Le mail ne peut pas être vide";
				// verif si le mail est dans un bon format
			}
			else if (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail))
			{
				$valid = false;
				$er_mail = "Le mail n'est pas valide";
			}
			else if ($mail === $login) {
				$valid = false;
				$er_mail = "Le login et le mail ne peuvent pas etre les memes";
			}
			else
			{
				$sql = $db->query('SELECT COUNT(*) AS existe_mail FROM User WHERE `mail` = "'.$mail.'"');
				while ($data = $sql->fetch()) // recup sous formne de tab les donnes de la table
				{
					//Si il n'y a aucune ligne le login est inexistant
					if (($data['existe_mail'] != '0')) {
						$valid = false;
						$er_login = ("Adresse email deja prise.");
					}
				}
			}
			// Vérification du mot de passe
			if(empty($mdp)) {
				$valid = false;
				$er_mdp = "Le mot de passe ne peut pas être vide";
			}
			else if ($mdp != $confmdp){
				$valid = false;
				$er_mdp = "La confirmation du mot de passe ne correspond pas";
			}
			if ($valid) {
				$mdph = hash("sha512", $mdp);
				//On insert de facon securisé les donnees recup
				$req = $db->prepare('INSERT INTO `User` (`login`, `prenom`, `nom`, `pp`, `mail`, `pwd`) VALUES (?, ?, ?, ?, ?, ?)');
				$req->execute(array($login, $nom, $prenom, "test", $mail, $mdph));
				header('Location: index.php');
				exit;
			}
		}
	}
?>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Inscription</title>
	</head>
	<body>
		<?php include 'menu.php' ?>
		<div>Inscription</div>
		<form method="post">
			<?php
				if (isset($er_login)){
					?>
					<div><?= $er_login ?></div>
					<?php   
				}
				?>
			<input type="text" placeholder="Votre login" name="login" value="<?php if(isset($login)){ echo $login; }?>" maxlength="8" required>   
			<?php
				if (isset($er_prenom)){
					?>
					<div><?= $er_prenom ?></div>
					<?php   
				}
				?>
			<input type="text" placeholder="Votre prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" maxlength="50" required>   
			<?php
					if (isset($er_nom)){
					?>
						<div><?= $er_nom ?></div>
					<?php   
					}
				?>
				<input type="text" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" maxlength="50" required>   
			<?php
				if (isset($er_mail)){
				?>
					<div><?= $er_mail ?></div>
				<?php   
				}
			?>
			<input type="email" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" maxlength="254" required>
			<?php
				if (isset($er_mdp)){
				?>
					<div><?= $er_mdp ?></div>
				<?php   
				}
			?>
			<input type="password" placeholder="Mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" maxlength="25" required>
			<input type="password" placeholder="Confirmer le mot de passe" name="confmdp" maxlength="25" required>
			<button type="submit" name="inscription">Envoyer</button>
		</form>
	</body>
</html>