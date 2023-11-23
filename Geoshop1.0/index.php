<?php
session_start();
require_once "php/config.php";

$sql = "SELECT * FROM analytics WHERE name = 'total_guest'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$totalGuest = $row['content'];
$currentGuest = $totalGuest + 1;
$sql = "UPDATE analytics SET content = ? WHERE name = 'total_guest'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentGuest);
$stmt->execute();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geoshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-image: url(images/indexBackground.png);
            background-repeat: no-repeat;
            background-size: cover;
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
    <header>
        <div class="container-fluid p-1 d-inline-flex shadow-sm" style="background-color: #F1F1F1;">
            <div class="float-start" style="margin-left: 2%;">
                <a href="index.php">
                    <img src="images/GeoshopLogo.png" alt="Geoshop Logo" width="25%" height="auto">
                    <b style="font-size: x-large;">Geoshop</b>
                </a>
            </div>
            <div class="d-flex ms-auto align-items-center">
                <a href="loginPage.php" class="me-2">Login</a>
                <a href="loginPage.php">
                    <img src="images/blankUser.png" alt="Guest" class="rounded-circle" width="50%" height="auto">
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="container-md text-center mt-4" style="margin-bottom: 40%;">
            <div>
                <p class="display-4 fw-bold fst-italic">"Shop anywhere, anytime"</p>
            </div>
            <div>
                <p class="text-center my-0">Geoshop uses geolocation feature</p>
                <p class="text-center my-0">to filter the nearest shops</p>
                <p class="text-center my-0">from your location.</p>
            </div>
            <br><br>
            <div class="text-center fs-6">
                Interested?
            </div>
            <a href="registerPage.php" class="btn btn-primary btn-lg px-5 text-light" id="registerButton">Register now</a>
            <div id="loginGuest" class="text-center">
                <p>or <a href="guest/guestMap.php?isGuest=1" style="color: blue;">continue as guest</a></p>
            </div>
        </div>
    </main>
    <?php require_once "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>