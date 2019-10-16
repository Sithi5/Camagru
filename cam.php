<!DOCTYPE html>
<html>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<script src="upload.js"></script>
		<style>
			#vid-show, #vid-canvas, #vid-take {
				margin-bottom: 20px;
			}
			#vid-show {
				width: 500px;
				transform: rotateY(180deg);
			}
			html, body {
				padding: 0;
				margin: 0;
			}
		</style>
	</head>
	<body>
		<div id="vid-controls">
			<div style="width: 500px;height:370px;border: solid 1px black"ondrop="drop(event)" ondragover="allowDrop(event)">
			<video id="vid-show" autoplay></video></div>
			<input id="vid-take" type="button" value="Take Photo"/>
			<div id="vid-canvas"></div>
		</div>
		<?php
			$filter = -3;
			$d = dir("./ressources/filters/.");
			while (false !== ($entry = $d->read())) {
				if (++$filter > 0) {
			?>
				<img style="width:100px;height:100px"id="<?php $result = "f" . $filter;
					echo $result ?>" class="filter-img" onclick="" href="#" draggable="true" ondragstart="drag(event)" src="../ressources/filters/<?=$entry?>" alt="filter">
			<?php
				}
			}
			$d->close();
			?>
		</div>
	</body>
</html>