<?php
session_destroy();
session_start();
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginEmail = $_POST["loginEmail"];
    $loginPassword = $_POST["loginPassword"];
    $randomizer = "1984";
    $passwordmd = md5($randomizer . md5($_POST["loginPassword"]));

    $sql = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $value1, $value2);
    $value1 = $loginEmail;
    $value2 = $passwordmd;
    $stmt->execute();

    if ($stmt->errno) {
        die();
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $profile = $result->fetch_assoc();
        header("Location: ../user/userMap.php");
    } else {
        echo "<a href='../loginPage.php'>Retry</a>";
        die("Invalid data");
    }

    $_SESSION["userId"] = $profile["user_id"];
    $_SESSION["username"] = $profile["username"];
    $_SESSION["email"] = $profile["email"];
    $_SESSION["password"] = $profile["password"];
    $_SESSION["isShop"] = $profile["is_shop"];
    $_SESSION["profilePicture"] = $profile["photo"];
    $_SESSION["warned"] = $profile["is_warn"];
    $_SESSION["timeout"] = $profile["is_timeout"];
    $_SESSION["banned"] = $profile["is_ban"];

    // Get shop data
    if ($_SESSION["isShop"] == 1) {
        $sql = "SELECT * FROM shops WHERE owner_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $value1);
        $value1 = $_SESSION["userId"];
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $_SESSION["assetId"] = $row["shop_id"];
        $_SESSION["assetName"] = $row["shop_name"];
        $_SESSION["assetPhoto"] = $row["photo"];
    }

    // Check if user's violator (do it when working on it)

    $stmt->close();
    $conn->close();
}
