<!DOCTYPE html>

<?php
// Si n'es pas executer a partir de index, go index
if ($magic != "c00f0c4675b91fb8b918e4079a0b1bac") {
	header('Location: index.php');
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
			$er_login_connect = ("Le login ne peut pas être vide");
		} else {
			$er_password_connect = ("Le mot de passe ne peut pas être vide");
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
			$er_login_connect = ("Le login ne correspond pas a un utilisateur inscrit");
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
				$er_password_connect = ("Le mot de passe ne correspond pas au login");
			}
		}
	}
}
if (isset($er_login_connect) || isset($er_password_connect))
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
		<a class="close" onclick="hide_modal_connect()">&#10006</a>
		<img src="./ressources\img\default.png" class="avatar">
		<form action="" method="post">
			<div class="form-group">
				<?php
				if (isset($er_login_connect)) {
					?>
					<p style="color:red;"><?= $er_login_connect ?></p>
				<?php
				}
				?>
				<br>
				<label for="Inputlogin1">Login</label>
				<br>
				<input class="" id="Inputlogin1" type="text" name="login" placeholder="Votre login" maxlength="10" required>
			</div>
			<div class="form-group">
				<?php
				if (isset($er_password_connect)) {
					?>
					<p style="color:red;"><?= $er_password_connect ?></p>
				<?php
				}
print_r($_POST);

				?>
				<label for="Inputpassword1">Password</label>
				<br>
				<input class="form-control" id="Inputpassword1" type="password" name="password" placeholder="Mot de passe" maxlength="25" required>
				<br>
				<small id="passwordHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
			</div>
			<button type="submit" data-dismiss = "modal" name="connexion" value="ok" class="" >Valider</button>
			<button type="button" name="Annuler" class="cancelbtn" onclick="hide_modal_connect()">Annuler</button>
		<br>
			<a type="onclick" href="#"  onclick="hide_modal_connect(), inscri_onclick()">Pas encore inscrit ?</a>
		</div>
		</form>
	</center>
</body>