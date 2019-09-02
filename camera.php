<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
</head>
<div class="parent_div_container_1">
	<div class="child-1">
		<?php $filtre = "" ?>
		<div id="cssfilters" style="text-align:center;">
			<video class="videostream" autoplay></video>
			<?php if ($filtre !== "") echo '<img id=filtre src="' . $filtre . '">' ?>
			<img id="screenshot-img">
			<p><button class="capture-button">Capture video</button>
				<p><button id="screenshot-button" disabled>Take screenshot</button></p>
				<p><button id="stop-button">Stop</button></p>
		</div>
	</div>
	<div class="child-2">
		<img class="filter-img" onclick="" href="#" src="./ressources/filters/sombrero.png" alt="filter">		
		<img class="filter-img" onclick="" href="#" src="./ressources/filters/beachball.png" alt="filter">		
	</div>
</div>


<!--script part-->
<script>
	function handleError(error) {
		console.error('navigator.getUserMedia error: ', error);
	}
	const constraints = {
		video: true
	};
	(function() {
		const captureVideoButton = document.querySelector('#cssfilters .capture-button');
		const video = document.querySelector('#cssfilters video');
		const screenshotButton = document.querySelector('#screenshot-button');
		const img = document.querySelector('#screenshot-img');
		const canvas = document.createElement('canvas');

		screenshotButton.onclick = video.onclick = function() {
			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext('2d').drawImage(video, 0, 0);
			// Other browsers will fall back to image/png
			img.src = canvas.toDataURL('image/png');
		};

		captureVideoButton.onclick = function() {
			navigator.mediaDevices.getUserMedia(constraints).
			then(handleSuccess).catch(handleError);
		};

		function handleSuccess(stream) {
			screenshotButton.disabled = false;
			localMediaStream = stream;
			video.srcObject = stream;
		}

		document.querySelector('#stop-button').onclick = function() {
			video.pause();
			localMediaStream.stop();
		};
	})();
</script>