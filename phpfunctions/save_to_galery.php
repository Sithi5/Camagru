<?php
session_start();

function save_to_galery()
{
	require '../config/database.php';
	if (!isset($_SESSION['logged_on'])) {
		echo "erreur, vous n'etes pas connecte";
	}
	else if (!isset($_SESSION['img']))
	{
		echo "pas de screenshot a upload";
	}
	else
	{
		echo "vous etes bien connecter, upload du screenshot...";
		$stmt = $db->prepare('INSERT INTO `Image` (`user_id`, `image_name`, `image_path`, `like`) VALUES (?, ?, ?, 0)');
		//Bind value.
		$stmt->execute(array($_SESSION['id'], strrchr($_SESSION['img'], "/"), $_SESSION['img']));
	}
}

if (isset($_POST['call']) && $_POST['call'] === "save_to_galery")
{
	save_to_galery();
}

?>