<?php
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $ownerId = $_SESSION["user_id"];
        $shopName = $_POST["shopName"];
        $ownerName = $_POST["ownerName"];
        $phoneNumber = $_POST["phoneNumber"];
        $longitude = $_POST["longitude"];
        $latitude = $_POST["latitude"];
        
        $sqlAddShop = "INSERT INTO shop_table (owner_id, shop_name, real_name, phone_number, longitude, latitude) VALUES ('$ownerId', '$shopName', '$realName', '$phoneNumber', '$longitude', '$latitude')";
        $conn->query($sqlAddShop);
        // $sqlGetShop = "SELECT * FROM shop_table WHERE owner_id = '$ownerId'";
        // $conn->query($sqlGetShop);

        $sqlAddIsShop = "UPDATE user_table SET is_shop = 1 WHERE user_id = '$ownerId'";
        $conn->query($sqlAddIsShop);
        
        // $sqlGetShop = "SELECT * FROM shop_table WHERE owner_id = '$ownerId'";
        // $sqlShop = $conn->query($sqlGetShop);

        // if ($sqlGetShop->num_rows > 0) {
        //     $shopData = $sqlGetShop->fetch_assoc();
        //     $shopId = $shopData["shop_id"];
        //     $ownerId = $shopData["owner_id"];
        //     $realName = $shopData["real_name"];
        //     $phoneNumber = $shopData["phone_number"];
        //     $shopName = $shopData["shop_name"];
        //     $ownerName = $shopData["owner_name"];
        // } else {
        //     die("Oops! Something went wrong.");
        // }
    }
    $conn->close();
    header("Location: ../page/shopProfile.php");
?>