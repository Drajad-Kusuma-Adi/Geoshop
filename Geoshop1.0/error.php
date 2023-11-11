<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FATAL ERROR</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #ffffff;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="container-fluid" style="margin-top: 40vh; margin-bottom: 40vh; width: 100vw; background-color: blue;">
            <div class="text-center text-white" style="font-size: xx-large;">:(</div>
            <div class="text-center text-white">Fatal Error: Something went wrong</div>
            <div class="text-center text-white">You will be redirected to the previous page after <span id="timeout"></span> seconds</div>
        </div>
    </main>

    <script>
        let timeoutSeconds = 5;

        setTimeout(() => {
            window.history.back();
        }, timeoutSeconds * 1000);

        let timeoutElement = document.getElementById('timeout');
        timeoutElement.textContent = timeoutSeconds;

        setInterval(() => {
            timeoutSeconds--;
            timeoutElement.textContent = timeoutSeconds;
        }, 1000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>