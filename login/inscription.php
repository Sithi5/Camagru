<?php
// Si n'es pas executer a partir de index, go index
if ($magic != "c00f0c4675b91fb8b918e4079a0b1bac") {
	header('Location: ./');
	exit();
}
if (isset($_POST) && !empty($_POST)) {
	extract($_POST);
	$valid = true;
	if (isset($_POST['inscription'])) {
		$login = htmlentities(trim($login));
		$prenom = htmlentities(trim($prenom));
		$nom  = htmlentities(trim($nom));
		$mail = htmlentities(strtolower(trim($mail)));
		$mdp = shamalo(htmlentities(trim($mdp)));
		$confmdp = shamalo(htmlentities(trim($confmdp)));
		if (empty($login)) {
			$valid = false;
			$er_login = ("Le login ne peut pas être vide");
		} else if (!empty($login)) {
			$sql = $db->query('SELECT COUNT(*) AS existe_pseudo FROM User WHERE `login` = "' . $login . '"');
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
		} else if (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)) {
			$valid = false;
			$er_mail = "Le mail n'est pas valide";
		} else if ($mail === $login) {
			$valid = false;
			$er_mail = "Le login et le mail ne peuvent pas etre les memes";
		} else {
			$sql = $db->query('SELECT COUNT(*) AS existe_mail FROM User WHERE `mail` = "' . $mail . '"');
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
		if (empty($mdp)) {
			$valid = false;
			$er_mdp = "Le mot de passe ne peut pas être vide";
		} else if ($mdp != $confmdp) {
			$valid = false;
			$er_mdp = "La confirmation du mot de passe ne correspond pas";
		}
		if ($valid) {
			//On insert de facon securisé les donnees recup
			$req = $db->prepare('INSERT INTO `User` (`login`, `prenom`, `nom`, `pp`, `mail`, `pwd`) VALUES (?, ?, ?, ?, ?, ?)');
			$req->execute(array($login, $prenom, $nom, './ressources/img/default.png', $mail, $mdp));
			header('Location: ./');
			exit();
		}
	}
}
?>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Inscription</title>
	<style>
		input {
			height: 25px;
			text-align: center;
		}
	</style>
</head>

<body>
	<center>
		<a class="modal-close-button" onclick="hide_modal_inscri()">&#10006</a>
		<h1 style="center">Inscription</h1>
		<form method="post">
			<div class="form-group">
				<?php
				if (isset($er_login)) {
					?>
					<p style="color:red;"><?= $er_login ?></p>
				<?php
				}
				?>
				<label for="Inputlogin2">Login</label>
				<input class="form-control" id="Inputlogin2" type="text" name="login" placeholder="Votre login" maxlength="10" required>
				<?php
				if (isset($er_prenom)) {
					?>
					<p style="color:red;"><?= $er_prenom ?></p>
				<?php
				}
				?>
				<label for="Inputprenom1">Prenom</label>
				<input type="text" class="form-control" id="Inputprenom1" placeholder="Votre prénom" name="prenom" value="<?php if (isset($prenom)) {
																																echo $prenom;
																															} ?>" maxlength="50" required>
				<?php
				if (isset($er_nom)) {
					?>
					<p style="color:red;"><?= $er_nom ?></p>
				<?php
				}
				?>
				<label for="Inputnom1">Prenom</label>
				<input type="text" class="form-control" id="Inputnom1" placeholder="Votre nom" name="nom" value="<?php if (isset($nom)) {
																														echo $nom;
																													} ?>" maxlength="50" required>
				<?php
				if (isset($er_mail)) {
					?>
					<p style="color:red;"><?= $er_mail ?></p>
				<?php
				}
				?>
				<label for="Inputemail1">Email</label>
				<input type="email" class="form-control" id="Inputemail1" placeholder="Adresse mail" name="mail" value="<?php if (isset($mail)) {
																															echo $mail;
																														} ?>" maxlength="50" required>
				<?php
				if (isset($er_password)) {
					?>
					<p style="color:red;"><?= $er_password ?></p>
				<?php
				}
				?>
				<label for="Inputpassword2">Password</label>
				<input class="form-control" id="Inputpassword2" type="password" name="mdp" placeholder="Mot de passe" maxlength="25" required>
				<label for="Inputpasswordconfirm1">Confirmation du password</label>
				<input type="password" id="Inputpasswordconfirm1" class="form-control" placeholder="Confirmer le mot de passe" name="confmdp" maxlength="25" required>
				<small id="passwordHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
				<br>
				<button type="submit" name="inscription" class="btn btn-primary btn-lg btn-block">Valider</button>
				<button type="button" name="Annuler" class="btn btn-warning btn-lg btn-block" onclick="hide_modal_connect()">Annuler</button>
				<a type="button" href="#" onclick="hide_modal_inscri(), connexion_onclick()">Deja un compte? Connexion</button>
			</div>

		</form>
	</center>
</body>

</html>