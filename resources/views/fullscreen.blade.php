<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calibration</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <!-- Your content here -->
    <button id="fullscreenButton">Enter Fullscreen</button>

    <script>
        const fullscreenButton = document.getElementById('fullscreenButton');

        // Function to request fullscreen
        function requestFullscreen() {
            const element = document.documentElement;

            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        }

        // Attach click event to the fullscreen button
        fullscreenButton.addEventListener('click', () => {
            requestFullscreen();
        });
    </script>
</body>
</html>
