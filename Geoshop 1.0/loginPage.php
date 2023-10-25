<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        body {
            background-color: #F1F1F1;
            color: black;
        }
        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <main class="container d-flex justify-content-center align-items-center" style="margin-top: 5%;">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <div class="row">
                <a href="index.php">
                    <div class="text-center">
                        <img src="images/GeoshopLogo.png" alt="Geoshop Logo" width="50%" height="auto">
                    </div>
                </a>
                <p class="fs-1 fw-bold text-center">Geoshop</p>
                <p class="fs-4 fst-italic text-center">"Shop anywhere, anytime"</p>
            </div>
            <div class="row" style="width: 90%;">
                <p class="text-center fs-2 fw-bold">Login User</p>
                <div class="container text-start shadow py-4" style="background-color: #F6F4EB;">
                    <div class="row text-center">
                        <form action="php/loginUser.php" method="POST">
                            <div>
                                <label for="loginEmail">
                                    Email
                                </label>
                                <br>
                                <input type="email" name="loginEmail" id="loginEmail" placeholder="Enter your email address" class="p-2 rounded-4 w-75 mb-3" required>
                            </div>
                            <div>
                                <label for="loginPassword">
                                    Password
                                </label>
                                <br>
                                <input type="password" name="loginPassword" id="loginPassword" placeholder="Enter your password" class="p-2 rounded-4 w-75 mb-3" required>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary mt-3 w-75" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex">
                    <p class="justify-content-start me-4">Don't have an account? <a href="registerPage.php" style="color: blue;">Register</a></p>
                    <p class="justify-content-end">Forgot your password? <a href="forgotPasswordPage.php" style="color: blue;">Reset password</a></p>
                </div>
            </div>
        </div>
    </main>
    <!-- <main class="container d-flex justify-content-center align-items-center " style="margin-top: 5%;">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row">
                <a href="index.php">
                    <div class="text-center">
                        <img src="images/GeoshopLogo.png" alt="Geoshop Logo">
                    </div>
                </a>
                <p class="fs-1 fw-bold text-center">Geoshop</p>
                <p class="fs-4 fst-italic text-center">"Shop anywhere, anytime"</p>
            </div>
            <div class="row ms-5" style="width: 75%;">
                <p class="text-center fs-2 fw-bold">Login User</p>
                <div class="container text-start shadow py-4" style="background-color: #F6F4EB;">
                    <div class="row text-center">
                        <form action="php/loginUser.php" method="POST">
                            <label for="loginEmail">
                                <img src="svg/emailEnvelope.svg" alt="Email" width="4%" height="4%">
                                Email
                            </label>
                            <input type="email" name="loginEmail" id="loginEmail" placeholder="Enter your email address" class="p-2 rounded-4 w-75 mb-3" required>
                            <label for="loginPassword">
                                <img src="svg/key.svg" alt="Password" width="4%" height="4%">
                                Password
                            </label>
                            <input type="password" name="loginPassword" id="loginPassword" placeholder="Enter your password" class="p-2 rounded-4 w-75 mb-3" required>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary mt-3 w-75" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex">
                    <p class="justify-content-start me-4">Don't have an account? <a href="registerPage.php" style="color: blue;">Register</a></p>
                    <p class="justify-content-end">Forgot your password? <a href="forgotPasswordPage.php" style="color: blue;">Reset password</a></p>
                </div>
            </div>
        </div>
    </main> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>