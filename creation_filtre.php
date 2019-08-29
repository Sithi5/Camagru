<?php
$png = imagecreatefrompng('ressources/filters/sombrero.png');
$jpeg = imagecreatefrompng('ressources/profile/default_f1.png');

list($width, $height) = getimagesize('ressources/profile/default_f1.png');
list($newwidth, $newheight) = getimagesize('ressources/filters/sombrero.png');
$out = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
imagejpeg($out, 'out.jpg', 100);
?>