<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="./css/camera.css">
</head>
<body>
	<div class="parent_div_container_3">
			<!-- left part of modal-->
			<div class="child-camera-1">
				<div id="vid-controls">
					<div style="overflow:hidden; width: 480px;height:480px;border: solid 1px black"ondrop="drop(event)" ondragover="allowDrop(event)">
							<video class="vid-class" id="vid-show" autoplay></video></div>
					<div style="width: 480px;height:480px;border: solid 1px black; position: relative;">
						<?php if (isset($_SESSION['img']) && file_exists($_SESSION['img'])) {
							echo '<img style="position: relative; max-width:100%; max-height:100%;" src="' . $_SESSION['img'] . '">';}?>
							</div>
							<center>
								<p>
									<button class="btn-camera" onclick="startWebcam();">Start WebCam</button>
									<button class="btn-camera" onclick="stopWebcam();">Stop WebCam</button> 
									<input type="button" id="vid-take" class="btn-camera" value="Take Photo"></button> 
								</p>
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
<script src="upload.js"></script>