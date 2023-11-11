<?php
session_start();
require_once "php/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-image: url("images/chatBackground.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color: black;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .message-box-me,
        .message-box-target {
            display: block;
            background-color: #F6F4EB;
            padding: 10px;
            border-radius: 20px;
            position: relative;
            margin-left: auto;
            margin-right: 0;
            text-align: left;
        }

        .message-box-me::after {
            content: "";
            position: absolute;
            bottom: 0;
            right: -10px;
            border-style: solid;
            border-width: 8px;
            border-color: transparent transparent black transparent;
            transform: rotate(45deg);
        }

        .message-box-target::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: -10px;
            border-style: solid;
            border-width: 8px;
            border-color: transparent transparent transparent black;
            transform: rotate(225deg);
        }

        .message-box-me::after {
            right: -10px;
        }

        .message-box-target::after {
            left: -10px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="container-fluid">
            <div class="text-start p-3 shadow h-100 border-bottom border-2 d-flex flex-column" style="background-color: #F6F4EB;">
                <div class="d-flex-flex-row">
                    <a href="chat.php" style="text-decoration: none; color:black;">
                        <svg width="36px" height="36px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                                <path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path>
                            </g>
                        </svg>
                    </a>
                    <img src="images/blankUser.png" alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
                    <span class="fs-4 fw-bold">User B</span>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="d-flex flex-column m-3">
            <div class="message-container" style="width: 100%; height: 100vh;">
                <!-- User A -->
                <div class="d-flex align-items-start" style="margin-left: 40vw;">
                    <img src="images/blankUser.png" alt="Profile Picture" class="rounded-circle me-2" width="36" height="36">
                    <span class="fs-5 fw-bold">User A</span>
                </div>
                <div class="message-box-me border border-1 border-black border-opacity-100 rounded p-2" style="margin-left: 40vw; margin-top: 10px;">
                    <h4>Username</h4>
                    <p>User A: Hello!</p>
                </div>
                <br>
                <!-- User B -->
                <div class="d-flex align-items-end" style="margin-top: 10px;">
                    <img src="images/blankUser.png" alt="Profile Picture" class="rounded-circle me-2" width="36" height="36">
                    <span class="fs-5 fw-bold">User B</span>
                </div>
                <div class="message-box-target border border-1 border-black border-opacity-100 rounded p-2" style="margin-right: 40vw; margin-top: 10px;">
                    <h4>Username</h4>
                    <p>User B: Hi there!</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column fixed-bottom position-fixed p-4" style="background-color: #F6F4EB;">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type your message...">
                    <label for="sendMessage" style="background-color: #0d6efd;" class="rounded-circle p-3 ms-3">
                        <svg fill="#ffffff" width="28px" height="28px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>paper-plane</title>
                                <path d="M0 14.016l9.216 6.912 18.784-16.928-14.592 20.064 10.592 7.936 8-32zM8 32l6.016-4-6.016-4v8z"></path>
                            </g>
                        </svg>
                        <input type="submit" id="sendMessage" style="display: none;">
                    </label>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>