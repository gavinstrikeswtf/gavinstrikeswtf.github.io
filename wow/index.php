<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gavinstrikes.wtf</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            overflow: hidden;
            background: url('https://images.hdqwalls.com/download/snow-covered-mountains-8k-sf-2560x1440.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
            z-index: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: relative;
            z-index: 1;
        }
        .verification-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: fadeInUp 1s ease-in-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .verification-box h1 {
            font-size: 1.8em;
            margin-bottom: 20px;
        }
        .verification-box button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1em;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }
        .verification-box button:hover {
            background: #45a049;
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.7);
        }
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2;
            transition: opacity 0.5s ease-in-out;
        }
        .popup-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            animation: popupFadeIn 0.5s ease-in-out;
            position: relative;
        }
        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
        }
        @keyframes popupFadeIn {
            from {opacity: 0; transform: scale(0.9);}
            to {opacity: 1; transform: scale(1);}
        }
        .popup-content img {
            width: 50px;
            height: 50px;
        }
        .popup-content h2 {
            margin-top: 20px;
        }
        .spinner {
            margin: 20px auto;
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid #4CAF50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .progress-bar-container {
            width: 100%;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .progress-bar {
            width: 0;
            height: 20px;
            background: linear-gradient(90deg, #4CAF50, #8BC34A);
            animation: fillProgressBar 4s linear;
        }
        @keyframes fillProgressBar {
            from { width: 0; }
            to { width: 100%; }
        }
    </style>
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="verification-box">
            <h1>Please verify yourself before downloading</h1>
            <form id="captcha-form" onsubmit="return validateCaptcha(event)">
                <div class="h-captcha" data-sitekey="3b38a7e2-d756-452a-b590-7a9d5af765d3"></div>
                <button type="submit">CONTINUE</button>
            </form>
        </div>
    </div>

    <div class="popup" id="success-popup">
        <div class="popup-content">
            <button class="popup-close" onclick="closePopup('success-popup')">&times;</button>
            <img src="checkmark.png" alt="Checkmark">
            <h2>You successfully completed the captcha!</h2>
            <h2>The download will start in a few seconds...</h2>
            <div class="spinner"></div>
            <div class="progress-bar-container">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <div class="popup" id="error-popup">
        <div class="popup-content">
            <button class="popup-close" onclick="closePopup('error-popup')">&times;</button>
            <img src="error-icon.png" alt="Error">
            <h2>Error! You haven't completed the captcha.</h2>
        </div>
    </div>

    <script>
        function validateCaptcha(event) {
            event.preventDefault();
            const hCaptchaResponse = document.querySelector('[name="h-captcha-response"]').value;
            if (!hCaptchaResponse) {

                const errorPopup = document.getElementById('error-popup');
                errorPopup.style.display = 'flex';
                errorPopup.style.opacity = '1';
                return false;
            }


            const successPopup = document.getElementById('success-popup');
            successPopup.style.display = 'flex';
            successPopup.style.opacity = '1';


            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.width = '100%';
            }, 100);


            setTimeout(() => {

                const link = document.createElement('a');
                link.href = "https://gavinstrikes.wtf/wowyoudidit.txt";
                link.download = "wowyoudidit.txt";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }, 4000);

            return true;
        }

        function closePopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.style.opacity = '0';
            setTimeout(() => {
                popup.style.display = 'none';
            }, 500);
        }
    </script>
</body>
</html>
