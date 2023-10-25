<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User - Geoshop</title>
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
            transform: translateY(20%);
        }
        #mainHeader {
            display: fixed;
            background-color: transparent;
            padding: 10px;
            text-align: center;
            font-size: xx-large;
        }

        #loginContainer {
            margin: 10px;
        }

        .input {
            border-radius: 10px;
            padding: 5px;
            width: 25%;
        }
        #submit {
            border-radius: 10px;
            padding: 10px;
            background-color: cyan;
        }
        @keyframes submitHover {
            from {
                opacity: 100%;
            }
            to {
                opacity: 50%;
            }
        }
        #submit:hover {
            cursor: pointer;
            animation: submitHover 0.5s forwards;
        }

        #navbar {
            background-color: white;
            padding: 10px;
        }
        #navbar a {
            text-decoration: none;
            font-size: small;
            color: black;
        }
        #loginErrorMessage {
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="mainContainer">
        <header>
            <!-- <div id="navbar" align="left">
                <a href="../index.php"><i class="fa-solid fa-house" style="color: #000000;"></i> | Home</a>
            </div> -->
            <div id="mainHeader">
                <h2>Geoshop Login</h2>
                <a href="../index.php">
                    <img src="../image/GeoshopLogo-removebg-preview.png" alt="Geoshop Logo" width="10%" height="10%">
                </a>
            </div>
        </header>
        <main>
            <div id="loginContainer" align="center">
                <form method="post" action="../service/login.php">
                    <div>
                        <label for="email"><h3><b><i class="fa-solid fa-envelope" style="color: #000000;"></i> Email </b><h3></label>
                        <input type="email" id="email" name="email" required placeholder="..." class="input">
                    </div>
                    <br>
                    <div>
                        <label for="password"><h3><b><i class="fa-solid fa-key" style="color: #000000;"></i> Password </b><h3></label>
                        <input type="password" id="password" name="password" placeholder="..." required class="input">
                    </div>
                    <br>
                    <input type="submit" id="submit" name="login" value="Login">
                </form>
            </div>
        </main>
    </div>
    <script src="https://kit.fontawesome.com/f677ead389.js" crossorigin="anonymous"></script>
</body>
</html>