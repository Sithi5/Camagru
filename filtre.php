<?php
	if (isset($_GET['filtre']) && isset($_GET['img']) && $_GET['filtre'] != "none"){
		$png = imagecreatefrompng($_GET['filtre']);
		$jpeg = imagecreatefrompng($_GET['img']);
		list($width, $height) = getimagesize($_GET['img']);
		$width = 480;
		$height = 480;
		list($newwidth, $newheight) = getimagesize($_GET['filtre']);
		$out = imagecreatetruecolor($width, $height);
		imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $width, $height, $width, $height);
		imagecopyresampled($out, $png, 0, 0, 0, 0, $width, $height, $newwidth, $newheight);
		imageflip($out, IMG_FLIP_HORIZONTAL);
		imagejpeg($out, $_GET['img'], 100);
	}
	else {
		$jpeg = imagecreatefrompng($_GET['img']);
		$width = 480;
		$height = 480;
		$out = imagecreatetruecolor($width, $height);
		imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $width, $height, $width, $height);
		imageflip($out, IMG_FLIP_HORIZONTAL);
		imagejpeg($out, $_GET['img'], 100);
	}
?>