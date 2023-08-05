<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
<style type="text/css">

body {
	margin: 0;
}

#video-demo-container {
	width: 100vh;
	margin: 40px auto;
}

#main-video {
	display: none;
	max-width: 400px;
}

#thumbnail-container {
	display: none;
}

#get-thumbnail {
	display: none;
}

#video-canvas {
	display: none;
}
#h2{
	text-align: center;
	font-size: 8vh;
	color: #fe4a55;
	font-family: 'Nunito',sans-serif;
	width: 100vh
}
#upload-button {
	width: 150px;
	display: block;
	margin: 20px auto;
	height: 40px;
	cursor: pointer;
	color: white;
	background-color: #fe4a55;
	border: none;
	outline: none;
	border-radius: 5px;
}

#file-to-upload {
	display: none;
}

</style>
</head>

<body>

<div id="video-demo-container">
	<h2 id="h2">InfiLearn Thumbnail</h2>
	<button id="upload-button" onclick="DataURL()">Select MP4 Video</button> 
	<input type="file" id="file-to-upload" accept="video/mp4" />
	<video id="main-video" controls>
		<source type="video/mp4">
	</video>
	<canvas id="video-canvas"></canvas>
	<div id="thumbnail-container">
		<a id="get-thumbnail" href="#">Download Thumbnail</a>
	</div>
</div>
<script>
	function DataURL() {

		var _CANVAS = document.querySelector("#video-canvas"),
			_CTX = _CANVAS.getContext("2d"),
			_VIDEO = document.querySelector("#main-video");

		// Upon click this should should trigger click on the #file-to-upload file input element
		// This is better than showing the not-good-looking file input element
		document.querySelector("#upload-button").addEventListener('click', function () {
			document.querySelector("#file-to-upload").click();
		});

		// When user chooses a MP4 file
		document.querySelector("#file-to-upload").addEventListener('change', function () {
			// Validate whether MP4
			if (['video/mp4'].indexOf(document.querySelector("#file-to-upload").files[0].type) == -1) {
				alert('Error : Only MP4 format allowed');
				return;
			}

			// Hide upload button
			document.querySelector("#upload-button").style.display = 'none';

			// Object Url as the video source
			document.querySelector("#main-video source").setAttribute('src', URL.createObjectURL(document.querySelector("#file-to-upload").files[0]));

			// Load the video and show it
			_VIDEO.load();
			_VIDEO.style.display = 'inline';

			// Load metadata of the video to get video duration and dimensions
			_VIDEO.addEventListener('loadedmetadata', function () {
				console.log(_VIDEO.duration);
				var video_duration = _VIDEO.duration,
					duration_options_html = '';

				var i = 0;
				// // Set options in dropdown at 4 second interval
				// // for(var i=0; i<Math.floor(video_duration); i++) {
				// 	duration_options_html += '<option value="' + i + '">' + i + '</option>';
				// // }
				// document.querySelector("#set-video-seconds").innerHTML = 0;

				// Show the dropdown container
				document.querySelector("#thumbnail-container").style.display = 'block';

				// Set canvas dimensions same as video dimensions
				_CANVAS.width = _VIDEO.videoWidth;
				_CANVAS.height = _VIDEO.videoHeight;
			});
		});

		// On changing the duration dropdown, seek the video to that duration
		// document.querySelector("#set-video-seconds").addEventListener('change', function() {
		//     _VIDEO.currentTime = document.querySelector("#set-video-seconds").value;

		//     // Seeking might take a few milliseconds, so disable the dropdown and hide download link 
		//     document.querySelector("#set-video-seconds").disabled = true;
		//     document.querySelector("#get-thumbnail").style.display = 'none';
		// });

		// Seeking video to the specified duration is complete 
		document.querySelector("#main-video").addEventListener('timeupdate', function () {
			// Re-enable the dropdown and show the Download link
			document.querySelector("#get-thumbnail").style.display = 'inline';
		});

		// On clicking the Download button set the video in the canvas and download the base-64 encoded image data
		document.querySelector("#get-thumbnail").addEventListener('click', function () {
			_CTX.drawImage(_VIDEO, 0, 0, _VIDEO.videoWidth, _VIDEO.videoHeight);

			document.querySelector("#get-thumbnail").setAttribute('href', _CANVAS.toDataURL());
			document.querySelector("#get-thumbnail").setAttribute('download', 'thumbnail.png');
		});
		return _CANVAS.toDataURL();
		
	}
</script>

</body>
</html>

