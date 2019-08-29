<?php
print_r($_POST);
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Test Webcam</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./test.css">
	</head>
	<body>
		<?php $filtre = "" ?>
		<center><div id="cssfilters" style="text-align:center;">
			<video class="videostream" autoplay></video>
			<?php if ($filtre !== "") echo '<img id=filtre src="' . $filtre . '">'?>
			<img id="screenshot-img">
			<p><button class="capture-button">Capture video</button>
			<p><button id="screenshot-button" disabled>Take screenshot</button></p>
			<p><button id="stop-button">Stop</button></p>
		</div></center>
		<form action="#" method="post">
			<label><input type="radio" name="filtre" value="sombrero"/><img class="images" src="./ressources/filters/sombrero.png"/></label>
			<label><input type="radio" name="filtre" value="beachball"/><img class="images" src="./ressources/filters/beachball.png"/></label>
			<input type="submit" value="Valider"/>
		</form>
		<script>
			function handleError(error) {
			console.error('navigator.getUserMedia error: ', error);
			}
			const constraints = {video: true};
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
	</body>
</html>