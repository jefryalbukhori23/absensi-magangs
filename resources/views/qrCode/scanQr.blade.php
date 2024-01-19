<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <video id="video" width="640" height="480" autoplay></video>
    <!-- <button id="startButton">Start Camera</button> -->
    <button id="startButton">Start Camera</button>

    <script>
        document.getElementById('startButton').addEventListener('click', function () {
            startCamera();
        });
        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    const video = document.getElementById('video');
                    video.srcObject = stream;
                    video.style.display = 'block';
                })
                .catch(error => console.error('Error accessing camera:', error));
        }
    </script>
</body>
</html>