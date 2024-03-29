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
            background-color: #F1F1F1;
            color: black;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .chatTab:hover {
            background-color: #F6F4EB;
            cursor: pointer;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="row">
            <div class="col-12 col-md-4 text-start p-3 shadow h-100 border-bottom border-2 d-flex flex-column" style="background-color: #F6F4EB;">
                <div class="d-flex-flex-row">
                    <a href="user/userMap.php" style="text-decoration: none; color:black;">
                        <svg width="36px" height="36px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                                <path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path>
                            </g>
                        </svg>
                    </a>
                    <div class="d-inline-block my-2 text-center">
                        <img src="images/GeoshopLogo.png" alt="Geoshop logo" width="25%" height="auto" style="margin-left: 2%;">
                        <span class="fs-3 fw-bold d-inline-block" style="margin-left: 2%;">Geoshop Chat</span>
                    </div>
                </div>
                <div class="d-flex flex-row align-self-center">
                    <div class="text-center">
                        <form action="" method="post">
                            <div class="bg-white p-1 rounded-pill border border-2" style="@media screen and (max-width: 768px) { width: 80vw; }">
                                <label style="cursor: pointer;">
                                    <input type="submit" value="" style="display: none;">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </label>
                                |
                                <input type="text" name="searchQuery" id="searchQuery" style="background-color: transparent; border: 0;" placeholder="Search for a chat">
                            </div>
                        </form>
                        <?php
                        // require_once "php/config.php";
                        // if (isset($_POST["searchQuery"])) {

                        // }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 text-start p-3 shadow border-bottom border-2" style="background-color: #F1F1F1; height: 100vh;">
                <div class="d-flex flex-column">
                    <?php
                    $sql = "SELECT * FROM chats WHERE sender_id=? OR target_id=?";
                    $stmt = $conn->prepare($sql);
                    $value1 = $_SESSION["userId"];
                    $stmt->bind_param("ss", $value1, $value1);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if ($_SESSION["userId"] === $rows[0]['sender_id']) {
                        $sql = "SELECT * FROM chats WHERE sender_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $_SESSION["userId"]);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                        $latestChatIndex = null;
                        $latestChatDatetime = null;

                        foreach ($rows as $index => $row) {
                            if ($row['target_id'] === $row['target_id']) {
                                if ($latestChatDatetime === null || $row['datetime'] > $latestChatDatetime) {
                                    $latestChatDatetime = $row['datetime'];
                                    $latestChatIndex = $index;
                                }
                            }
                        }

                        if ($latestChatIndex !== null) {
                            foreach ($rows as $index => $row) {
                                if ($row['target_id'] === $row['target_id'] && $index !== $latestChatIndex) {
                                    unset($rows[$index]);
                                }
                            }
                        }
                    } else if ($_SESSION["userId"] === $rows[0]['target_id']) {
                        $sql = "SELECT * FROM chats WHERE target_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $_SESSION["userId"]);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                        $latestChatIndex = null;
                        $latestChatDatetime = null;

                        foreach ($rows as $index => $row) {
                            if ($row['sender_id'] === $row['sender_id']) {
                                if ($latestChatDatetime === null || $row['datetime'] > $latestChatDatetime) {
                                    $latestChatDatetime = $row['datetime'];
                                    $latestChatIndex = $index;
                                }
                            }
                        }

                        if ($latestChatIndex !== null) {
                            foreach ($rows as $index => $row) {
                                if ($row['sender_id'] === $row['sender_id'] && $index !== $latestChatIndex) {
                                    unset($rows[$index]);
                                }
                            }
                        }
                    }

                    $rows = array_values($rows);
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>