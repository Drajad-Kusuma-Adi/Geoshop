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
            background-image: url("images/indexBackground.png");
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
                        <?php
                        if (isset($_GET["invalid"])) {
                            if ($_GET["invalid"] == 1) {
                                echo "<p class='text-white text-center bg-danger p-2 mt-2 mb-0'>Invalid email or password</p>";
                            } else if ($_GET["invalid"] == 2) {
                                echo "<p class='text-white text-center bg-danger p-2 mt-2 mb-0'><button type='button' class='bg-transparent' data-bs-toggle='modal' data-bs-target='#invalidEmailPopup' style='border: 0;'><span style='text-decoration: underline; color: #ffffff;'>Invalid</span></button> email for reset password</p>";
                            }
                        }
                        ?>
                        <div id="invalidEmailPopup" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">What does "invalid" mean?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            <li class="text-start">The email address is not found in our records</li>
                                            <li class="text-start">The user account associated with this email is banned</li>
                                            <li class="text-start">There was an error processing the reset password request</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <p class="justify-content-start me-4">Don't have an account? <a href="registerPage.php" style="color: blue;">Register</a></p>
                    <p class="justify-content-end">Forgot your password? <button type="button" class="bg-transparent" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" style="border: 0;"><span style="color: blue;">Reset Password</span></button></p>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="forgotPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Forgot Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="php/forgotPassword.php" method="GET">
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email address</label>
                            <input name="resetEmail" type="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-fullscreen">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        Reset Password
                    </div>
                    <div class="card-body">
                        <form action="php/resetPassword.php" method="POST">
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmNewPassword" required>
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" class="btn btn-primary" value="Reset Password">
                                <a href="loginPage.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>