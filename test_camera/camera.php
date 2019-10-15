<!DOCTYPE html>
<html>
		<link rel="stylesheet" type="text/css" href="../css/camera.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<script src="upload.js"></script>
		<style>
			#vid-show, #vid-canvas, #vid-take {
				margin-bottom: 20px;
			}
			html, body {
				padding: 0;
				margin: 0;
			}
		</style>
	</head>
	<body>
		<div id="vid-controls">
			<div ondrop="drop(event)" ondragover="allowDrop(event)"><video id="vid-show" autoplay></video></div>
			<input id="vid-take" type="button" value="Take Photo"/>
			<div id="vid-canvas"></div>
		</div>
		<?php $filter = 0 ?>
		<img id="<?php $result = "f" . $filter++;
					echo $result ?>" class="filter-img" onclick="" href="#" draggable="true" ondragstart="drag(event)" src="../ressources/filters/sombrero.png" alt="filter">
		<img id="<?php $result = "f" . $filter++;
					echo $result ?>" class="filter-img" onclick="" href="#" draggable="true" ondragstart="drag(event)" src="../ressources/filters/like.png" alt="filter">

</div>
	</body>
</html>