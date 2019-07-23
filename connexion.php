<!DOCTYPE html>

<?php
session_start();
require 'config/database.php';
require 'config/connexiondb.php';
require 'hash.php';

// Si session dans ce cas go index
if (isset($_SESSION['loggued_on'])) {
	header('Location: ./');
	exit();
}
if (isset($_POST) && !empty($_POST)) {
	extract($_POST);
	$login = htmlentities(trim($login));
	$password = shamalo(htmlentities(trim($password)));
//verify if login and password are provided
	if (empty($login) || empty($password)) {
		$valid = false;
		if (empty($login)) {
			$er_login = ("Le login ne peut pas être vide");
		} else {
			$er_password = ("Le mot de passe ne peut pas être vide");
		}
	} else {
		$sql = "SELECT `login`, id, pwd, `super-root` FROM user WHERE `login` = :login";
		$stmt = $db->prepare($sql);

		//Bind value.
		$stmt->bindValue(':login', $login);

		//Execute.
		$stmt->execute();

		//Fetch row return the result of the sql request as an array. NULL if no result.
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($user === false) {
			$er_login = ("Le login ne correspond pas a un utilisateur inscrit");
		} else {
			if ($user['pwd'] === $password) {
				$_SESSION['id'] = $user['id'];
				$_SESSION['user_login'] = $user['login'];
				$_SESSION['loggued_on'] = "1";
				$_SESSION['logged_in'] = time();
				if ($user['super-root'] == 1) {
					$_SESSION['sa'] = "1";
				}
				header('Location: ./');
				exit();
			} else {
				$er_password = ("Le mot de passe ne correspond pas au login");
			}
		}
	}
}
?>


<html lang="fr">

<head>
	<meta charset="utf-16">
	<title>Inscription</title>
	<style>
		input {
			height: 25px;
			text-align: center;
		}
	</style>
</head>

<body>
<?php include 'menu.php' ?>
<center>
	<h1 style="center">Connexion</h1>
	<form action="" method="post">
		<?php
			if (isset($er_login)){
		?>
			<div><?= $er_login ?></div>
		<?php
			}
		?>
		<input size=50 type="text" name="login" placeholder="Votre login" maxlength="10" required>
		<br>
		<br>
		<?php
			if (isset($er_password)){
		?>
			<div><?= $er_password ?></div>
		<?php
			}
		?>
		<input size=50 type="password" name="password" placeholder="Mot de passe" maxlength="25" required>
		<br>
		<br>
		<input type="submit">
	</form>
	</center>
</body>