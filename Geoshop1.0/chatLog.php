<?php
session_start();
require_once "php/config.php";

$sql = "SELECT * FROM `chats` WHERE (`sender_id` = ? AND `target_id` = ?) OR (`sender_id` = ? AND `target_id` = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $_SESSION["userId"], $_GET["targetId"], $_GET["targetId"], $_SESSION["userId"]);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_all(MYSQLI_ASSOC);

if (isset($row)) {
    $sql = "SELECT * FROM `users` WHERE `user_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_GET["targetId"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $targetRow = $result->fetch_assoc();

    if ($targetRow) {
        $targetName = $targetRow["username"];
        $targetPhoto = $targetRow["photo"];
    } else {
        header("Location: error.php");
        die();
    }
} else {
    header("Location: error.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat <?php echo $targetName ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="d-flex flex-row align-items-center border-bottom border-2 p-2 shadow" style="background-color: #F6F4EB;">
            <a href="user/shopView.php" class="d-flex text-start align-items-center text-dark text-decoration-none">
                <svg width="36px" height="36px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                        <path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path>
                    </g>
                </svg>
            </a>
            <div class="d-flex text-start align-items-center">
                <img src="profilePicture/<?php
                                            if ($targetPhoto) {
                                                echo $targetPhoto;
                                            } else {
                                                echo "blankUser.jpg";
                                            }
                                            ?>" alt="Geoshop logo" width="36" height="36" class="rounded-circle m-2">
                <span class="fs-3 fw-normal"><?php
                                                echo $targetName;
                                                ?></span>
            </div>
        </div>
    </header>
    <?php
    $previousDate = null;

    if ($row == null) {
        echo '
            <div class="container my-3">
                <div class="row justify-content-center">
                <div class="col-9 text-center opacity-50">
                    Use the textbox below to type and send message
                </div>
                </div>
            </div>
        ';
    }

    foreach ($row as $chat) {
        $senderId = $chat["sender_id"];
        $targetId = $chat["target_id"];
        $content = $chat["content"];
        $datetime = $chat["datetime"];

        $sql = "SELECT * FROM `users` WHERE `user_id`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $senderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $senderRow = $result->fetch_assoc();

        if ($senderRow) {
            $senderName = $senderRow["username"];
            $senderPhoto = $senderRow["photo"];
        } else {
            header("Location: error.php");
            die();
        }

        $formattedDate = date("Y-m-d", strtotime($datetime));

        if ($formattedDate !== $previousDate) {
            echo '<div class=" col-6 rounded-4 fs-4 fw-bold text-center p-2" style="background-color: #F6F4EB;">' . $formattedDate . '</div>';
            $previousDate = $formattedDate;
        }

    ?>
        <!-- TODO: Style message box -->
        <div class="container my-3">
            <span>(<?php echo date("H:i", strtotime($datetime)); ?>) </span>
            <span><?php echo $senderName ?>: </span>
            <span><?php echo $content ?></span>
        </div>
        <br>
    <?php
    }
    ?>
    <footer>
        <form action="php/sendMessage.php?targetId=<?php echo $_GET["targetId"] ?>" method="POST">
            <input type="text" name="message" placeholder="Type your message" autocomplete="off">
            <label class="rounded-circle p-2 bg-primary" style="cursor: pointer;">
                <input type="submit" value="Send" style="display: none;">
                <svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>paper-plane</title>
                        <path d="M0 14.016l9.216 6.912 18.784-16.928-14.592 20.064 10.592 7.936 8-32zM8 32l6.016-4-6.016-4v8z"></path>
                    </g>
                </svg>
            </label>
        </form>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>