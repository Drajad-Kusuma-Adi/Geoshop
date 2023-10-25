<?php
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newPassword = $_POST["newPassword"];
        $confirmNewPassword = $_POST["confirmNewPassword"];
        $randomizer = "1984";
        $passwordmd = md5($randomizer.md5($confirmNewPassword));
        $userId = $_POST["userId"];

        if ($newPassword != $confirmNewPassword) {
            echo "<a href='../index.php'>Back to home</a>";
            die("Passwords do not match");
        }

        $sql = "UPDATE users SET password=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $value1, $value2);
        $value1 = $passwordmd;
        $value2 = $userId;
        $stmt->execute();

        if ($stmt->errno) {
            echo "<a href='../index.php'>Back to home</a>";
            die("Something went wrong, please try again");
        }
    }

    echo "<a href='../loginPage.php'>Login</a>";
    echo "Reset password successfully";
    $stmt->close();
    $conn->close();
?>