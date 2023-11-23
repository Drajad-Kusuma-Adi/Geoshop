<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Continue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-image: url(../images/indexBackground.png);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: black;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <main>
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
            <img src="../images/GeoshopLogo.png" alt="Geoshop Logo" width="25%" height="auto" class="text-center">
            <p class="fs-1 fw-bold text-center">Login to continue using our services</p>
            <a href="../loginPage.php" class="btn btn-primary btn-lg px-5 text-light text-center">Login</a>
            <p class="text-center">Don't have an account? <a href="../registerPage.php" style="color: blue;">Register</a> </p>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>