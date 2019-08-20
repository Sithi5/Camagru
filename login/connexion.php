<!DOCTYPE html>

<?php
// Si n'es pas executer a partir de index, go index
if ($magic != "c00f0c4675b91fb8b918e4079a0b1bac") {
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
				$_SESSION['logged_on'] = "1";
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
if (!isset($_POST) || empty($_POST) || isset($er_login) || isset($er_password))
{
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
	<center>
		<h1 style="center">Connexion</h1>
		<a class="modal-close-button" onclick="hide_modal_connect()">&#10006</a>
		<img src="./ressources\img\default.png" class="avatar">
		<form action="" method="post">
			<div class="form-group">
				<?php
				if (isset($er_login)) {
					?>
					<p style="color:red;"><?= $er_login ?></p>
				<?php
				}
				?>
				<label for="Inputlogin1">Login</label>
				<input class="form-control" id="Inputlogin1" type="text" name="login" placeholder="Votre login" maxlength="10" required>
			</div>
			<div class="form-group">
				<?php
				if (isset($er_password)) {
					?>
					<p style="color:red;"><?= $er_password ?></p>
				<?php
				}
				?>
				<label for="Inputpassword1">Password</label>
				<input class="form-control" id="Inputpassword1" type="password" name="password" placeholder="Mot de passe" maxlength="25" required>
				<small id="passwordHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
			</div>
			<button type="submit" data-dismiss = "modal" name="connexion" class="btn btn-success btn-lg btn-block" style="width: 40vw">Valider</button>
			<button type="button" name="Annuler" class="btn btn-warning btn-lg btn-block" style="width: 40vw" onclick="hide_modal_connect()">Annuler</button>
			<button type="button" href="#" class="btn btn-info btn-lg btn-block" style="width: 20vw" onclick="hide_modal_connect(), inscri_onclick()">Inscription</button>
		</div>
		</form>
	</center>
</body>