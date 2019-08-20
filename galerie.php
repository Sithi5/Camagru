<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
?>
<html>
	<head>
		<meta http-equiv="refresh" content="60" />

		<meta charset="UTF-16">
		<title>Mes projets Web</title>
		<link rel="stylesheet" type="text/css" href="./css/slideshow.css">
		<link rel="stylesheet" type="text/css" href="./css/modal.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	</head>
	<body>
		<?php include 'menu.php' ?>
		<center><span style="text-decoration: underline;"><h2>WALL OF FAME</h2></span></center>
		<?php
		$liste = $db->query('SELECT `Image`.image_path, `Image`.id as id_image FROM `Image`');
		$liste = $liste->fetchALL();
		foreach ($liste as $donnees) {
			?><a href="./post.php?img=<?= $donnees['id_image']?>"><img style ="width:300px; height:300px; margin-top:10px; margin-left:10px; margin-right:10px;" src= "<?php echo $donnees['image_path']?>"></a>
		<?php
		}
		?>
	</body>
</html>
