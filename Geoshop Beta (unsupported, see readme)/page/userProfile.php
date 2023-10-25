<?php
    session_start();
    $userIdProfile = $_SESSION["user_id"];
    $usernameProfile = $_SESSION["username"];
    $emailProfile = $_SESSION["email"];
    $userIsShop = $_SESSION["is_shop"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geoshop User Profile: <?php echo $usernameProfile ?></title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
            background-image: url(../image/wavyCyanWhiteBackground.png);
            background-repeat: no-repeat;
            background-size: cover;
        }

        #mainContainer {
            display: flexbox;
            justify-content: center;
            align-items: center;
        }
        #mainHeader {
            background-color: transparent;
            padding: 10px;
            margin: 10px;
            font-size: xx-large;
        }
        #accountType {
            width: 100%;
            height: fit-content;
            border-radius: 100px;
            background-color: transparent;
        }
        #navbar {
            background-color: transparent;
            padding: 10px;
        }
        #navbar a {
            text-decoration: none;
            padding: 10px;
            background-color: cyan;
            color: black;
            border: 2px solid blue;
            border-radius: 100px;
            font-size: x-large;
        }
        #profileImage {
            border: 2px solid black;
            border-radius: 100px;
            width: 100px;
            height: 100px;
        }
        #profileImage:hover {
            cursor: pointer;
            opacity: 50%;
        }
        #userData {
            font-size: larger;
        }
    </style>
</head>
<body>
    <header>
        <div id="mainHeader" align="center">
            <h1><?php echo $usernameProfile ?></h1>
            <br>
            <div id="profileImage">
                <img src="../image/typeUser-removebg-preview.png" alt="Account Type: User" width="100%" height="100%">
            </div>
        </div>
    </header>
    <main>
        <div id="mainContainer">
            <br>
            <div id="navbar" align="center">
                <div>
                    <table id="userData">
                        <tr>
                            <td><i class="fa-solid fa-user" style="color: #000000;"></i> </td>
                            <td>Username </td>
                            <td>: </td>
                            <td> <?php echo $usernameProfile ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-id-card" style="color: #000000;"></i> </td>
                            <td>User ID </td>
                            <td>: </td>
                            <td> <?php echo $userIdProfile ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-envelope" style="color: #000000;"></i> </td>
                            <td>Email </td>
                            <td>: </td>
                            <td> <?php echo $emailProfile ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user-tie" style="color: #000000;"></i></td>
                            <td>Shop Owner </td>
                            <td>: </td>
                            <td> 
                                <?php
                                    if ($userIsShop == 1) {
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <br><br><br>
                </div>
                <a href="mapView.php"><i class="fa-solid fa-map-location-dot" style="color: #000000;"></i> Map View</a>
                <br><br><br>
                <?php
                    if ($userIsShop == 1) {
                        echo "<a href='shopProfile.php'><i class='fa-solid fa-shop' style='color: #000000;'></i> Login Shop</a>";
                    } else {
                        echo "<a href='registerShopPage.php'><i class='fa-solid fa-shop' style='color: #000000;'></i> Register Shop</a>";
                    }
                ?>
                <br><br><br>
                <a href="../index.php"><i class="fa-solid fa-right-from-bracket" style="color: #000000;"></i> Logout</a>
                <br><br><br>
                <!-- TODO: That's definitely not a logout system, please fix -->
            </div>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/f677ead389.js" crossorigin="anonymous"></script>
</body>
</html>