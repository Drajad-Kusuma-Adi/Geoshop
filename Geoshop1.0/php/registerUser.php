<?php
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registerEmail = $_POST["registerEmail"];
    $registerUsername = $_POST["registerUsername"];
    $registerPassword = $_POST["registerPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    $randomizer = "1984";
    $passwordmd = md5($randomizer . md5($_POST["registerPassword"]));

    if ($registerPassword != $confirmPassword) {
        header("Location: ../registerPage.php?invalid=1");
        die("Password unconfirmed");
    }

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $value);
    $value = $registerEmail;
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->errno) {
        header("Location: ../error.php");
        die();
    }

    if ($result->num_rows > 0) {
        header("Location: ../registerPage.php?exist=1");
        die();
    } else {
        $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $value1, $value2, $value3);
        $value1 = $registerEmail;
        $value2 = $registerUsername;
        $value3 = $passwordmd;
        $stmt->execute();

        if ($stmt->errno) {
            header("Location: ../error.php");
            die();
        }
    }

    $stmt->close();
    $conn->close();
}
header("Location: ../loginPage.php");
