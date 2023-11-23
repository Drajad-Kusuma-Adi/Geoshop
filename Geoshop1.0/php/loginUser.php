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
    $result = $stmt->get_result();

    if ($stmt->errno) {
        header("Location: ../error.php");
        exit("FATAL ERROR!");
    }

    if ($result->num_rows > 0) {
        $profile = $result->fetch_assoc();
        $_SESSION["userId"] = $profile["user_id"];
        $_SESSION["username"] = $profile["username"];
        $_SESSION["email"] = $profile["email"];
        $_SESSION["isShop"] = $profile["is_shop"];
        $_SESSION["profilePicture"] = $profile["photo"];
        $_SESSION["warned"] = $profile["is_warn"];
        $_SESSION["timeout"] = $profile["is_timeout"];
        $_SESSION["timeoutEnd"] = $profile["timeout_end"];
        $_SESSION["banned"] = $profile["is_ban"];
        $_SESSION["admin"] = $profile["is_admin"];
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
            $_SESSION["assetLatitude"] = $row["latitude"];
            $_SESSION["assetLongitude"] = $row["longitude"];
        }
        if ($_SESSION["warned"] == 1) {
            header("Location: ../user/userMap.php?warned=" . $_SESSION["userId"]);
            exit("You have been warned.");
        }
        if ($_SESSION["timeout"] == 1 && $_SESSION["timeoutEnd"] > date("Y-m-d")) {
            header("Location: ../loginPage.php?timeout=1&timeoutEnd=" . $_SESSION["timeoutEnd"]);
            exit("Your session has timed out.");
        }
        if ($_SESSION["banned"] == 1) {
            session_destroy();
            header("Location: ../loginPage.php?banned=1");
            exit("Your account has been banned.");
        }
        header("Location: ../user/userMap.php");
        exit();
    } else {
        header("Location: ../loginPage.php?invalid=1");
        exit("Invalid data");
    }

    $stmt->close();
    $conn->close();
}
