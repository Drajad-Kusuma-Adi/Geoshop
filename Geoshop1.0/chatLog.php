<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
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

    $previousDate = null;

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
            echo '<div class="fs-6 fw-bold">' . $formattedDate . '</div>';
            $previousDate = $formattedDate;
        }

    ?>
        <!-- TODO: Style message box -->
        <span>
            <span>(<?php echo date("H:i", strtotime($datetime)); ?>) </span>
            <span><?php echo $senderName ?>: </span>
            <span><?php echo $content ?></span>
        </span>
        <br>
    <?php
    }
    ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>