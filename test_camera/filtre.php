<?php
	$png = imagecreatefrompng($_GET['filtre']);
	$jpeg = imagecreatefrompng($_GET['img']);
	list($width, $height) = getimagesize($_GET['img']);
	list($newwidth, $newheight) = getimagesize($_GET['filtre']);
	$out = imagecreatetruecolor($newwidth, $newheight);
	imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
	imagejpeg($out, $_GET['img'], 100);
	print_r($_GET);
?>