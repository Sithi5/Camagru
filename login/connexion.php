<?php
// Si n'es pas executer a partir de index, go index
if ($magic != "c00f0c4675b91fb8b918e4079a0b1bac") {
	header('Location: ../');
	exit();
}
if (isset($_POST) && !empty($_POST)) {
	extract($_POST);
	if (isset($loginco))
	{
			$loginco = htmlentities(trim($loginco));
			$passwordco = shamalo(htmlentities(trim($passwordco)));
		//verify if login and password are provided
		if (empty($loginco) || empty($passwordco)) {
			$valid = false;
			if (empty($loginco)) {
				$er_login_connect = ("Le login ne peut pas être vide");
			} else {
				$er_password_connect = ("Le mot de passe ne peut pas être vide");
			}
		} else {
			$sql = "SELECT `login`, id, pwd, `super-root` FROM user WHERE `login` = :login";
			$stmt = $db->prepare($sql);

			//Bind value.
			$stmt->bindValue(':login', $loginco);

			//Execute.
			$stmt->execute();

			//Fetch row return the result of the sql request as an array. NULL if no result.
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($user === false) {
				$er_login_connect = ("Le login ne correspond pas a un utilisateur inscrit");
			} else {
				if ($user['pwd'] === $passwordco) {
					$_SESSION['id'] = $user['id'];
					$_SESSION['user_login'] = $user['login'];
					$_SESSION['logged_on'] = "1";
					$_SESSION['logged_in'] = time();
					if ($user['super-root'] == 1) {
						$_SESSION['sa'] = "1";
					}
					exit();
				} else {
					$er_password_connect = ("Le mot de passe ne correspond pas au login");
				}
			}
		}
	}
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-16">
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="./css/modal.css">
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
		<a class="close" onclick="hide_modal(1)">&#10006</a>
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
				<input class="" id="Inputlogin1" type="text" name="loginco" placeholder="Votre login" maxlength="10" required>
			</div>
			<div class="form-group">
				<?php
				if (isset($er_password_connect)) {
					?>
					<p style="color:red;"><?= $er_password_connect ?></p>
				<?php
				}
				?>
				<label for="Inputpassword1">Password</label>
				<br>
				<input class="form-control" id="Inputpassword1" type="password" name="passwordco" placeholder="Mot de passe" maxlength="25" required>
				<br>
				<small id="passwordHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
			</div>
			<button type="submit" data-dismiss = "modal" name="connexion" class="btn" value="ok">Valider</button>
			<button type="button" name="Annuler" class="cancelbtn btn" onclick="hide_modal(1)">Annuler</button>
		<br>
			<button type="button" href="#" class="cobtn btn" onclick="hide_modal(1), modal_onclick(2)">Pas encore inscrit ?</button>		
		</div>
		</form>
	</center>
</body>