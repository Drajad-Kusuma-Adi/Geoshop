<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User - Geoshop</title>
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
            /* transform: translateY(-20%); */
        }
        #mainHeader {
            display: fixed;
            padding: 10px;
            text-align: center;
            font-size: xx-large;
        }

        #registerContainer {
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
            color: black;
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
            color: black;
            font-size: smaller;
        }
        #confirmPasswordErrorMessage {
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="mainContainer">
        <header>
            <div id="mainHeader">
                <!-- <div id="navbar" align="center">
                    <a href="../index.php">⬅️ Home</a>
                    <a href="loginPage.php">⬅️ Login</a>
                </div> -->
                <h2>Geoshop Register</h2>
                <a href="../index.php">
                    <img src="../image/GeoshopLogo-removebg-preview.png" alt="Geoshop Logo" width="10%" height="10%">
                </a>
            </div> 
        </header>
        <main>
            <div id="registerContainer" align="center">
                <form method="post" action="../service/register.php">
                    <div>
                        <label for="emailRegister"><h3><b><i class="fa-solid fa-envelope" style="color: #000000;"></i> Register Email </b></h3></label>
                        <input type="email" id="emailRegister" name="emailRegister" required placeholder="example@example.com" class="input">
                    </div>
                    <br>
                    <div>
                        <label for="usernameRegister"><h3><b><i class="fa-solid fa-user" style="color: #000000;"></i> Create Username </b></h3></label>
                        <input type="text" id="usernameRegister" name="usernameRegister" placeholder="Create a unique username" required class="input">
                    </div>
                    <br>
                    <div>
                        <label for="password"><h3><b><i class="fa-solid fa-key" style="color: #000000;"></i> Create Password </b></h3></label>
                        <input type="password" id="passwordRegister" name="passwordRegister" placeholder="Create a secure password" required class="input">
                    </div>
                    <br>
                    <div>
                        <label for="phoneNumber"><h3><b><i class="fa-solid fa-phone" style="color: #000000;"></i> Phone Number </b></h3></label>
                        <input type="text" id="phoneNumber" name="phoneNumber" required placeholder="Enter your phone number" class="input">
                    </div>
                    <br>
                    <input type="submit" id="submit" name="register" value="Register">
                </form>
            </div>
        </main>
    </div>
    <script src="https://kit.fontawesome.com/f677ead389.js" crossorigin="anonymous"></script>
</body>
</html>