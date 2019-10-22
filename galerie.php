<?php
session_start();
require './config/database.php';
require './config/connexiondb.php';
require './hashing/hash.php';
require './phpfunctions/mdp_is_secure.php';
require './phpfunctions/number_format.php';
$magic = "c00f0c4675b91fb8b918e4079a0b1bac";

if (!isset($_SESSION['element_per_page']) || $_SESSION['element_per_page'] < 1)
{	
	$_SESSION['element_per_page'] = 12;
}
if (!isset($total_image))
{
$sth = $db->prepare('SELECT count(*) as total from `image`');
$sth->execute();
$total_image = $sth->fetch()[0];
}

$element_per_page = $_SESSION['element_per_page'];
$start = 0;
?>
<html>

<head>
	<meta charset="UTF-16">
	<title>galerie</title>
	<link rel="stylesheet" type="text/css" href="./css/galerie.css">
	<link rel="stylesheet" type="text/css" href="./css/modal.css">
	<link rel="stylesheet" type="text/css" href="./css/post.css">
</head>

<body>
	<?php include 'menu.php' ?>
	<center>
	<span style="text-decoration: underline;">
		<h2 class="name-galery-txt">WALL OF FAME : <?php echo $_SESSION['element_per_page']?> elements displayed</h2>
	</span>
	<center>
	<div class="galery">
		<article class="galery-flex-container" style="margin-bottom: 5px;">
			<?php
			$liste = $db->query("SELECT `Image`.image_path, `Image`.id as id_image, `Image`.`like` FROM `Image` LIMIT ".$start.", ".$element_per_page."");
			$liste = $liste->fetchALL(PDO::FETCH_ASSOC);
			$liste = array_reverse($liste, TRUE);

			$count = 10;
			$div = 0;
			foreach ($liste as $donnees) {
				if ($div % 3 == 0)
					echo '<div class="column-galery">';
				?>
				<div class="galery-img-container-margin<?php if ($div % 3 == 2) echo '_last'?>">
					<a onclick="modal_onclick(<?= $count ?>)" href="#">
						<div class="galery-img-container">
							<img class="img-in-galery"  src="<?php echo $donnees['image_path'] ?>">
							<div class="overlay">
								<div class="text"><img class="jaimee" src="./ressources/img/jaime.png"><?= number_format_short($donnees['like']) ?>
								</div>
							</div>
						</div>
					</a>
				</div>
				<!-- The Modal Images -->
				<div id="modal<?= $count ?>" class="modal">
					<div class="modal-image-post">
						<?php include "./post.php" ?>
					</div>
				</div>
			<!-- End of Modal -->
			<?php
				$count++;
				if ($div % 3 == 2)
					echo "</div>";
				$div++;
			}
			while ($div % 3 != 0)
			{
			?>
				<div class="galery-img-container-margin<?php if ($div % 3 == 2) echo '_last'?>">
					<div class="galery-img-container">
					</div>
				</div>
			<?php
				$div++;
			}?>
		</article>
	</div>

	<!-- The Modal connection -->
	<div id="modal01" class="modal">
		<div class="modal-content">
			<?php
			include './login/connexion.php' ?>
		</div>
	</div>
	<!-- End of Modal -->
	<!-- The Modal inscription -->
	<div id="modal02" class="modal">
		<div class="modal-content">
			<?php
			include './login/inscription.php' ?>
		</div>
	</div>
	<!-- End of Modal -->
</body>
<?php include 'footer.html' ?>

</html>


<script>
//mise en place du scroll event
	$(window).scroll(function() {;
  if ($(window).scrollTop() + window.innerHeight == $(document).height()) {
	  <?php
	  if ($_SESSION['element_per_page'] < $total_image)
	  {
			$_SESSION['element_per_page'] += 12;
			echo "location.reload();";
	  }
	  ?>
	}
});
//fin scroll event
</script>

<script src="./script/modal.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>