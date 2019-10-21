<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php'; 
	require './phpfunctions/number_format.php';
	// S'il n'y a pas de session alors on ne va pas sur cette page
	if (!isset($_SESSION['logged_on']) || $_SESSION['logged_on'] == '0'
		|| !isset($_SESSION['id']) || $_SESSION['id'] == "0") {
		header('Location: ./'); 
		exit; 
	}
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Upload une image</title>
		<head>
	<body>
		<?php include("menu.php") ?>
		<form action="phpfunctions/upload_file.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload" required>
			<input type="submit" value="Upload Image" name="submit">
		</form>
		<?php if (isset($_SESSION['error'])) {
			echo '<p>' . $_SESSION['error'] . '</p>';}
			if (isset($_SESSION['img_uploaded'])) {
				echo '<img style="width: 200px;height:200px" id="img-screenshot" src="./ressources/uploads/' . $_SESSION['img_uploaded'] . '">';}
			else
				echo '<img style="width: 200px;height:200px" id="img-screenshot" src="./ressources/img/blank.png">';?>
	</body>
</html>
<script src=""></script>
