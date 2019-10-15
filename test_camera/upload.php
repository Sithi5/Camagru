<?php
	$source = $_FILES["upimage"]["tmp_name"];
	$destination = uniqid() . '.png';
	$file = "../ressources/screenshots/" . $destination;
	echo move_uploaded_file($source, $file) ? "OK" : "ERROR UPLOADING";

	$png = imagecreatefrompng('../ressources/filters/sombrero.png');
	$jpeg = imagecreatefrompng($file);
	list($width, $height) = getimagesize($file);
	list($newwidth, $newheight) = getimagesize('../ressources/filters/sombrero.png');
	$out = imagecreatetruecolor($newwidth, $newheight);
	imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
	imagejpeg($out, $file, 100);
?>