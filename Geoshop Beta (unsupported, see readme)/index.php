<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geoshop</title>
    <meta name="description" content="Get the nearest souvenir from your location with Geoshop!">
    <style>
        * {
    padding: 0;
    margin: 0;
    }
    @keyframes fadeInInitial {
        0% {
            opacity: 0;
        }
        20% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        color: black;
        background-image: url(image/wavyCyanWhiteBackground.png);
        background-repeat: no-repeat;
        background-size: cover;
        /* animation: fadeInInitial 4s forwards;
        animation-delay: 1s;
        opacity: 0; */
    }

    .header {
        background-color: transparent;
        text-align: center;
        padding: 10px;
        font-size: 200%;
        font-weight: bold;
    }

    #loginRegisterContainer {
        display: block;
        text-align: center;
    }
    #loginButton {
        flex: 1;
        background-color: black;
        color: white;
        border-radius: 10px;
        padding: 10px;
        margin-left: 100px;
        margin-right: 100px;
        margin-bottom: 10px;
        margin-top: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
    }
    #registerButton {
        flex: 1;
        background-color: blue;
        color: white;
        border-radius: 10px;
        padding: 10px;
        margin-left: 100px;
        margin-right: 100px;
        margin-top: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
    }
    @keyframes fadeInWhenHover {
        from {
            opacity: 100%;
        }
        to {
            opacity: 50%;
        }
    }
    #loginButton:hover, #registerButton:hover {
        cursor: pointer;
        animation: fadeInWhenHover 0.5s forwards;
        -webkit-animation: fadeInWhenHover 0.5s forwards;
    }
    </style>
</head>
<body>
    <header>
        <div class="header">
            <img src="image/GeoshopLogo-removebg-preview.png" alt="Geoshop Logo">
            <h1>Geoshop</h1>
            <h6>Shop anywhere, anytime</h6>
        </div>
    </header>
    <main>
        <div id="loginRegisterAnnouncement">
            
        </div>
        <div id="loginRegisterContainer">
            <div id="registerButton">Register</div>
            <div id="loginButton">Login</div>
        </div>
    </main>
    <script src="page/script/registerLogin.js"></script>
</body>
</html>