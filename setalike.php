<?php
session_start();
require './config/database.php';
require './config/connexiondb.php';
// Si user logged go index
if (empty($_SESSION) || $_SESSION['logged_on'] != 1)
{
	echo "Connect if you want to like this image.";
	exit();
}
if($_POST['action'] == 'call_a_like') {
$users = $db->query('SELECT id, img_id, liker_id  FROM `like`
					WHERE img_id = "'.$_POST['img_id'].'"
					AND liker_id = "'.$_SESSION['id'].'"');
$users_liked = $users->fetch();
if (isset($users_liked) && $users_liked['id'] >= 1)
{
	$like = -1;
	$users = $db->query('DELETE FROM `like` WHERE id = "'.$users_liked['id'].'"');
	echo "Picture unliked!";
}
else
{
	$like = 1;
	$req = $db->prepare("INSERT INTO `like` (`img_id`, `liker_id`) VALUES (?, ?)");
	$req->execute(array($_POST['img_id'], $_SESSION['id']));
	echo "Picture liked!";
}
$db->query('UPDATE `image` SET `like` = `like` + "'.$like.'" WHERE id = "'.$_POST['img_id'].'"');
}