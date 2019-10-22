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
		<style>
		.parent_div_container {
			position: relative;
			display: flex;
			align-content: stretch;
			width: 80%;
		}
		.child-upload-1,
		.child-upload-2 {
			position: relative;
			overflow: hidden;
			width: 50%;
		}
		.upload-div {
			position: relative;
			overflow: hidden;
			width: 480px;
			height: 480px;
			border: solid 1px black;
		}
		.filtre {
			position: absolute;
			width: 100px;
			height: 100px;
			right: calc(50% - 50px);
			top: calc(50% - 50px);
			z-index: 1;
		}
		.btn-upload {
			background-color: rgb(36, 156, 212);
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			margin-top: 1px;
			border: none;
			border-radius: 10%;
			cursor: pointer;
			width: 20%;
			font-size: 13px;
		}
		</style>
	<head>
	<body>
		<?php include("menu.php") ?>
		<form action="phpfunctions/upload_file.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload" required>
			<input type="submit" value="Upload Image" name="submit">
		</form>
		<?php if (isset($_SESSION['error'])) {
					echo '<p style="text-align:center">' . $_SESSION['error'] . '</p>';}?>
		<?php if (isset($_SESSION['img_uploaded'])) {
		?>
		<div class="parent_div_container">
			<div class="child-upload-1">
				<center>
				<div class="upload-div" ondrop="drop_upload(event)" ondragover="allowDrop(event)">
					<img style="display:none ;" class="filtre" id="img-preview-in-upload">
					<img id="img_upload" src="./ressources/uploads/<?=$_SESSION['img_uploaded']?>">
				</div>
				<button class="btn-upload" onclick="myAjaxSendToGalerylocal()" value="Upload Image" id="save-upload">Save to galery</button>
			</div>
			<div class="child-upload-2">
				<center>
				<?php
					$filter = -2;
					$d = dir("./ressources/filters/.");
					while (false !== ($entry = $d->read())) {
						if (++$filter > 0) {
				?>
				<img id="<?php $result = "f" . $filter;
					echo $result ?>" class="filter-img" onclick="onclickfilter_upload(this.id)" href="#" draggable="true" ondragstart="drag(event)" src="./ressources/filters/<?=$entry?>" alt="filter">
				<?php
						}
					}
					$d->close();
				?>
				</center>
			</div>
		</div>
		<?php } ?>
	</body>
</html>
<script src="./script/upload.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./script/ajax.js"></script>
