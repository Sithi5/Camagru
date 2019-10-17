<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
	<link rel="stylesheet" type="text/css" href="./css/camera.css">
</head>
<body>
	<div class="parent_div_container_3">
		<!-- left part of modal-->
		<div class="child-camera-1">
		<center>
			<div class="camera-div" style=""ondrop="drop(event)" ondragover="allowDrop(event)">
					<video class="vid-class" id="vid-show" autoplay></video>
			</div>
				<p>
					<button class="btn-camera" onclick="startWebcam();">Start WebCam</button>
					<button class="btn-camera" onclick="stopWebcam();">Stop WebCam</button> 
					<button id="vid-take" class="btn-camera" value="Take Photo">Take a Picture</button> 
				</p>
			</center>
			<div id="vid-canvas">
			</div>
		</div>
		<!-- right part of modal-->
		<div class="child-camera-2">
		<center>
			<?php
				$filter = -3;
				$d = dir("./ressources/filters/.");
				while (false !== ($entry = $d->read())) {
					if (++$filter > 0) {
			?>
			<img id="<?php $result = "f" . $filter;
				echo $result ?>" class="filter-img" onclick="" href="#" draggable="true" ondragstart="drag(event)" src="../ressources/filters/<?=$entry?>" alt="filter">
			<?php
					}
				}
				$d->close();
			?>
			<div class="screenshot-div">
				<?php if (isset($_SESSION['img']) && file_exists($_SESSION['img'])) {
					echo '<img id="img-screenshot" src="' . $_SESSION['img'] . '">';}?>
			</div>
		</div>
	</center>
	</div>
</body>
<script src="./script/upload.js"></script>