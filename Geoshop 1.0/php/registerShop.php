<?php
session_start();
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registerShopName = $_POST["shopName"];
    $registerLatitude = $_POST["latitude"];
    $registerLongitude = $_POST["longitude"];

    $sql = "SELECT * FROM shops WHERE owner_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $value1);
    $value1 = $_SESSION["userId"];
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->errno) {
        echo "Error: " . $stmt->error;
        echo "<a href='../user/userProfile.php'>Go back</a>";
        die();
    }
    if ($result->num_rows > 0) {
        header("Location: ../user/userProfile.php");
        die();
    } else {
        $sql = "INSERT INTO shops (shop_name, latitude, longitude, owner_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $value1, $value2, $value3, $value4);
        $value1 = $registerShopName;
        $value2 = $registerLatitude;
        $value3 = $registerLongitude;
        $value4 = $_SESSION["userId"];
        $stmt->execute();

        if ($stmt->errno) {
            echo "Error: " . $stmt->error;
            echo "<a href='../user/userProfile.php'>Go back</a>";
            die();
        }

        $sql = "UPDATE users SET is_shop = 1 WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION["userId"]);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    $_SESSION["isShop"] = 1;
    header("Location:../user/userProfile.php");
}
