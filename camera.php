<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/camera.css">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<script src="upload.js"></script>
</head>
	<body>
		<div class="parent_div_container_3">
			<!-- left part of modal-->
			<div class="child-camera-1">
				<div id="vid-controls">
					<div style="width: 500px;height:370px;border: solid 1px black"ondrop="drop(event)" ondragover="allowDrop(event)">
					<video class="vidclass" id="vid-show" autoplay></video></div>
					<center>
					<input id="vid-take" type="button" class="btn" value="Take Photo"/>
					</center>
					<div id="vid-canvas"></div>
				</div>
			</div>
			<!-- right part of modal-->
			<div class="child-camera-2">
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
	</div>