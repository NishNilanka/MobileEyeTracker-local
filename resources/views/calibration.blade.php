<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calibration</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #f0f0f0;
            overflow: hidden;
        }

        .calibration-container {
            position: relative;
            width: 100%;
            height: 100vh; /* Make the container full height */
        }

        .calibration-point {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color: red; /* Change the background color to red */
            border-radius: 50%;
            animation: pulse 1s infinite;
            display: none; /* Initially hide all points */
        }

        .center-ball {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color: red;
            border-radius: 50%;
            display: none; /* Initially hide center ball */
        }

        .button-container {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="calibration-container">
        <div class="calibration-point" style="top: 10px; left: 10px;"></div>
        <div class="calibration-point" style="top: 10px; right: 10px;"></div>
        <div class="calibration-point" style="bottom: 10px; left: 10px;"></div>
        <div class="calibration-point" style="bottom: 10px; right: 10px;"></div>
        <div class="calibration-point" style="top: 50%; left: 50%;"></div>
        <div class="center-ball" style="top: 50%; left: 50%;"></div>
    </div>

    <div class="button-container">
        <button class="button proceed-button" style="display: none;">Proceed</button>
        &nbsp;
        
        <button class="button recalibrate-button" style="display: none;">Recalibrate</button>
    </div>

    <script>
        // Get all calibration points and center ball
        const calibrationPoints = document.querySelectorAll('.calibration-point');
        const proceedButton = document.querySelector('.proceed-button');
        const recalibrateButton = document.querySelector('.recalibrate-button');

        let currentIndex = 0;
        let calibrationDone = false;

        // Function to display the current calibration point
        function displayCalibrationPoint() {
            if (currentIndex < calibrationPoints.length) {
                // Hide all points and center ball
                calibrationPoints.forEach(point => point.style.display = 'none');

                // Display the current point
                calibrationPoints[currentIndex].style.display = 'block';
                console.log(currentIndex);
                // Move to the next point after 3 seconds
                currentIndex++;
                setTimeout(displayCalibrationPoint, 3000);
            } else {
                // Show center ball and buttons
                //centerBall.style.display = 'none';
                calibrationPoints[currentIndex-1].style.display = 'none';
                proceedButton.style.display = 'inline-block';
                recalibrateButton.style.display = 'inline-block';

                // Add click event listeners to buttons
                proceedButton.addEventListener('click', () => {
                    // Proceed to the next page
                    alert('Proceed to the next page');
                });

                recalibrateButton.addEventListener('click', () => {
                    // Recalibrate by restarting the calibration
                    currentIndex = 0;
                    displayCalibrationPoint();
                    recalibrateButton.style.display = 'none';
                    proceedButton.style.display = 'none';
                });
            }
        }

        // Start displaying calibration points
        displayCalibrationPoint();

        // Enter fullscreen when using Chrome browser
        const isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
        if (isChrome) {
            document.body.requestFullscreen();
        }
    </script>
</body>
</html>
