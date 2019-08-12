<html><head>
<meta charset="utf-8">
<meta content="Webcam" name="title">
<title>Webcam</title>
<style>

	#videoElement {
	width: 500px;
	height: 375px;
	background-color: #666;
	}
	
	button {
	margin-top: 20px;
	font-size: 12px;
	padding: 5px;
	background-color: white;
	}

	button:hover {
	background-color: green;
	}

</style>
</head>
<body>
<h1>Webcam</h1>
<div id="container">
<video autoplay="true" id="videoElement">
</video>
</div>
<button id="stop">Stop</button>
<script>
	var video = document.querySelector("#videoElement");
	var stopVideo = document.querySelector("#stop");

	if (navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({ video: true })
		.then(function (stream) {
		video.srcObject = stream;
		})
		.catch(function (err0r) {
		console.log("Something went wrong!");
		});
	}

	stopVideo.addEventListener("click", stop, false);

	function stop(e) {
	var stream = video.srcObject;
	var tracks = stream.getTracks();

	for (var i = 0; i < tracks.length; i++) {
		var track = tracks[i];
		track.stop();
	}

	video.srcObject = null;
	}
</script>

</body></html>